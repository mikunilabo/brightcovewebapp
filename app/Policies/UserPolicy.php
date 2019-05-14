<?php
declare(strict_types=1);

namespace App\Policies;

use App\Contracts\Domain\ModelContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;

final class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user
     * @param  string  $ability
     * @return boolean|null
     */
    public function before(User $user, string $ability): ?bool
    {
        return null;
    }

    /**
     * @param User $user
     * @param ModelContract $model
     * @return bool
     */
    public function select(User $user, ModelContract $model): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param ModelContract $model
     * @return bool
     */
    public function update(User $user, ModelContract $model): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param ModelContract $model
     * @return bool
     */
    public function delete(User $user, ModelContract $model): bool
    {
        if ($user->id !== $model->id) {
            return true;
        }

        return false;
    }
}
