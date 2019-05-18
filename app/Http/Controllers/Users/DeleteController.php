<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\UseCases\Users\DeleteUser;

final class DeleteController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param DeleteUser $useCase
     * @return void
     */
    public function __construct(DeleteUser $useCase)
    {
        $this->middleware([
            'authorize:user-delete',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param string $userId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(string $userId)
    {
        $user = $this->useCase->user($userId);

        $this->authorize('delete', $user);

        $callback = function () use ($user) {
            $this->useCase->excute([
                'entity' => $user,
            ]);
        };

        if (! is_null(rescue($callback, false))) {
            return back()
                ->with('alerts.danger', [__('An internal server error has occurred. Please contact the administrator.')])
                ->withInput();
        }

        return redirect()
            ->route('accounts.index')
            ->with('alerts.info', [__('The :name information was :action.', ['name' => __('Account'), 'action' => __('Delete')])]);
    }
}
