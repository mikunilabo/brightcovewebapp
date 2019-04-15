<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\UseCases\Users\UpdateUser;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class UpdateController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param UpdateUser $useCase
     * @return void
     */
    public function __construct(UpdateUser $useCase)
    {
        $this->middleware([
            'authenticate',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param string $userId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(string $userId)
    {
        $user = $this->useCase->user($userId);

        $this->authorize('select', $user);

        return view('users.update', [
            'row' => $user,
        ]);
    }

    /**
     * @param ValidatesWhenResolved $request
     * @param string $userId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(UpdateRequest $request, string $userId)
    {
        $user = $this->useCase->user($userId);

        $this->authorize('update', $user);

        $args = $request->validated();

        $callback = function () use ($user, $args) {
            $this->useCase->excute([
                'entity' => $user,
                'param'  => $args,
            ]);
        };

        if (! is_null(rescue($callback, false))) {
            return back()
                ->with('alerts.danger', [__('An internal server error has occurred. Please contact the administrator.')])
                ->withInput();
        }

        return redirect()
            ->route('accounts.update', $userId)
            ->with('alerts.success', [__('The :name information was :action.', ['name' => __('Accounts'), 'action' => __('Update')])]);
    }
}
