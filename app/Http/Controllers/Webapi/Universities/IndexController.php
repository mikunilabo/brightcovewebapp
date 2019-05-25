<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Universities;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Universities\IndexRequest;
use App\UseCases\Universities\GetUniversities;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class IndexController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param GetUniversities $useCase
     * @return void
     */
    public function __construct(GetUniversities $useCase)
    {
        $this->middleware([
            'authorize:user-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
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
