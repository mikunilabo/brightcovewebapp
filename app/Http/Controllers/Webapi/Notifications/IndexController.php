<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Universities\IndexRequest;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class IndexController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(IndexRequest $request)
    {
        try {
            return $request->user()
                ->notifications()
                ->whereNull('read_at')
                ->get();
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
