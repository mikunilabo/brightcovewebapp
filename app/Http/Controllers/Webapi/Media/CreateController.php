<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\CreateRequest;
use App\UseCases\Media\CreateMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class CreateController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param CreateMedia $useCase
     * @return void
     */
    public function __construct(CreateMedia $useCase)
    {
        $this->middleware([
            'authenticate',
            'authorize:media-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(CreateRequest $request)
    {
        $args = $request->validated();
        $args['uuid'] = $request->user()->id;
        $args['state'] = 'INACTIVE';

        try {
            return $this->useCase->excute([
                'param' => $args,
            ]);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
