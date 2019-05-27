<?php
declare(strict_types=1);

namespace App\Http\Controllers;

final class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
//         $user = auth()->user();
//         return $user->unreadNotifications;

//         foreach ($user->unreadNotifications as $notification) {
//             dd($notification->notifiable);
//         }

        return view('home');
    }
}
