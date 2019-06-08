<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Media\ActivatesRequest;
use App\UseCases\Media\ActivatesMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class ActivatesController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param ActivatesMedia $useCase
     * @return void
     */
    public function __construct(ActivatesMedia $useCase)
    {
        $this->middleware([
            'authorize:media-update',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ActivatesRequest $request)
    {
        $args = $request->validated();

        $media = $this->useCase->media($args);

        $filtered = $media->filter(function ($item) use ($request) {
            return $request->user()->can('update', $item);
        });

        return $this->useCase->excute([
            'ids' => $filtered->pluck('id')->all(),
        ]);
    }
}
