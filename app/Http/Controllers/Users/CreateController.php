<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\UseCases\Users\CreateUser;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class CreateController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param CreateUser $useCase
     * @return void
     */
    public function __construct(CreateUser $useCase)
    {
        $this->middleware([
            'authenticate',
            'authorize:user-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view()
    {
        return view('users.create');
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(CreateRequest $request)
    {
        $args = $request->validated();

        $callback = function () use ($args) {
            $this->useCase->excute([
                'param' => $args,
            ]);
        };

        if (($result = rescue($callback, false)) === false) {
            return back()
                ->with('alerts.danger', [__('An internal server error has occurred. Please contact the administrator.')])
                ->withInput();
        }

        return redirect()
            ->route('accounts.index')
            ->with('alerts.success', [__('The :name information was :action.', ['name' => __('Account'), 'action' => __('Create')])]);
    }
}
