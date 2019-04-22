<?php
declare(strict_types=1);

namespace App\Listeners\Users;

use App\Model\Eloquent\LoginHistory;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

final class LoginListener
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->loginHistories()->save(new LoginHistory([
            'ip' => $this->request->getClientIp(),
            'host' => $this->request->getHttpHost(),
            'user_agent' => $this->request->userAgent(),
            'remote_port'  => $this->request->server('REMOTE_PORT'),
            'access_port' => $this->request->getPort(),
            'created_at' => now(),
        ]));
    }
}
