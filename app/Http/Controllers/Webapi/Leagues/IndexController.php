<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Leagues;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Leagues\IndexRequest;
use App\UseCases\Leagues\GetLeagues;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class IndexController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param GetLeagues $useCase
     * @return void
     */
    public function __construct(GetLeagues $useCase)
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
