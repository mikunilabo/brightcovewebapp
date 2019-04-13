<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

final class Authorize
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $args
     * @return mixed
     */
    public function handle($request, Closure $next, string $args = '')
    {
        if ($request->user()->can('authorize', explode('|', $args))) {
            return $next($request);
        }

        throw new AuthorizationException('This action is unauthorized.');
    }
}
