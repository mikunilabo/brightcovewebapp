<?php
declare(strict_types=1);

namespace App\Http\Controllers\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\IndexRequest;
use App\UseCases\Media\GetMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class IndexController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param GetMedia $useCase
     * @return void
     */
    public function __construct(GetMedia $useCase)
    {
        $this->middleware([
            'authenticate',
            'authorize:media-select',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(IndexRequest $request)
    {
        return view('media.index', [
            'rows' => $this->useCase->excute([
                'param' => $request->validated(),
            ]),
        ]);
    }
}
