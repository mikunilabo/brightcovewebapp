<?php
declare(strict_types=1);

namespace App\Providers;

use App\Model\Eloquent;
use App\Policies;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Eloquent\User::class => Policies\UserPolicy::class,
    ];

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('authorize', function (Authenticatable $user, ...$args): bool {
            foreach (is_array($args) ? $args : [$args] as $arg) {
                if ($user->role->permissions->containsStrict('slug', $arg)) {
                    return true;
                }
            }
            return false;
        });
    }
}
