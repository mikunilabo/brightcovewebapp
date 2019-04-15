<?php
declare(strict_types=1);

namespace App\Policies;

use App\Model\Eloquent\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
     * @param  User  $user
     * @param  User  $targetUser
     * @return bool
     */
    public function select(User $user, User $targetUser): bool
    {
        if ($user->can('authorize', 'user-select')) {
            return true;
        }

        return false;
    }

    /**
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        if ($user->can('authorize', 'user-create')) {
            return true;
        }

        return false;
    }

    /**
     * @param  User  $user
     * @param  User  $targetUser
     * @return bool
     */
    public function update(User $user, User $targetUser): bool
    {
        if ($user->can('authorize', 'user-update')) {
            return true;
        }

        return false;
    }

    /**
     * @param  User  $user
     * @param  User  $targetUser
     * @return bool
     */
    public function delete(User $user, User $targetUser): bool
    {
        if ($user->id !== $targetUser->id
            && $user->can('authorize', 'user-delete')
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  User  $user
     * @param  User  $targetUser
     * @return bool
     */
    public function restore(User $user, User $targetUser): bool
    {
        return false;
    }

    /**
     * @param  User  $user
     * @param  User  $targetUser
     * @return bool
     */
    public function changeRole(User $user, User $targetUser): bool
    {
//         if ($user->can('authorize', config('permissions.groups.user-create'))) {
//             return true;
//         }

//         if ($user->id !== $targetUser->id) {
//             return true;
//         }

        return false;
    }

}
