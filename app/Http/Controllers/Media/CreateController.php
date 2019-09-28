<?php
declare(strict_types=1);

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;

final class CreateController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
            'assert_video_cloud',
            'authorize:media-create',
        ]);
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke()
    {
        return view('media.upload');
    }
}
