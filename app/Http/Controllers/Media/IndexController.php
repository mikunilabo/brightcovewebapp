<?php
declare(strict_types=1);

namespace App\Http\Controllers\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\IndexRequest;
use App\UseCases\Media\GetMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class IndexController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param GetMedia $useCase
     * @return void
     */
    public function __construct(GetMedia $useCase)
    {
        $this->middleware([
            'assert_video_cloud',
            'authorize:media-select',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(IndexRequest $request)
    {
        $args = array_merge($request->validated(), [
            'uuid' => $request->user()->id,
        ]);

        $media = $this->useCase->excute([
            'param' => $args,
        ]);

        $filtered = $media->filter(function ($item) use ($request) {
            return $request->user()->can('select', $item);
        });

        return view('media.index', [
            'rows' => $filtered,
        ]);
    }
}
