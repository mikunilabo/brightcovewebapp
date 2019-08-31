<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

final class AssertVideoCloud
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $client = (new \App\Repositories\Vendor\VideoCloud\MediaRepository)->client();

        if (! $client->accountId() || ! $client->clientId() || ! $client->clientSecret()) {
            return redirect()
                ->route('home')
                ->with('alerts.danger', [__('You do not have VideoCloud credentials.')])
                ->withInput();
        }

        return $next($request);
    }
}
