<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\IndexRequest;
use App\UseCases\Users\GetUsers;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class IndexController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param GetUsers $useCase
     * @return void
     */
    public function __construct(GetUsers $useCase)
    {
        $this->middleware([
            'authorize:user-select',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(IndexRequest $request)
    {
        return view('users.index', [
            'rows' => $this->useCase->excute([
                'param' => $request->validated(),
            ]),
        ]);
    }
}
