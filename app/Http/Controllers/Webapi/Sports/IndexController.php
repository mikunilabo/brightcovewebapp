<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Sports;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Sports\IndexRequest;
use App\UseCases\Sports\GetSports;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class IndexController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param GetSports $useCase
     * @return void
     */
    public function __construct(GetSports $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(IndexRequest $request)
    {
        $args = $request->validated();

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
