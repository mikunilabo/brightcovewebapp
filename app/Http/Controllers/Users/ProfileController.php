<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ProfileRequest;
use App\UseCases\Users\UpdateProfile;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Http\Request;

final class ProfileController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param UpdateProfile $useCase
     * @return void
     */
    public function __construct(UpdateProfile $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request)
    {
        return view('users.profile', [
            'row' => $request->user(),
        ]);
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(ProfileRequest $request)
    {
        $user = $request->user();
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
            ->route('accounts.profile')
            ->with('alerts.success', [__('The :name information was :action.', ['name' => __('Profile'), 'action' => __('Update')])]);
    }
}
