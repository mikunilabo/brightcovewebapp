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
        $this->middleware([
            'authorize:user-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(IndexRequest $request)
    {
        $args =  array_merge($request->validated(), [
            'select' => [
                'id',
                'name',
            ],
            'orders' => [
                'latest' => 'created_at',
            ],
        ]);

        return $this->useCase->excute([
            'param' => $args,
        ]);
    }
}
