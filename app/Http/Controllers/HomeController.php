<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class HomeController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('home');
    }
}
