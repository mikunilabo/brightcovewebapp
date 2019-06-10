<?php
declare(strict_types=1);

namespace App\Http\Controllers;

final class PhpinfoController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
            'authorize:user-create',
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        phpinfo();
    }
}
