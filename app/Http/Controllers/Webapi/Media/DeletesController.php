<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Media\DeletesRequest;
use App\UseCases\Media\DeletesMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class DeletesController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param DeletesMedia $useCase
     * @return void
     */
    public function __construct(DeletesMedia $useCase)
    {
        $this->middleware([
            'authenticate',
            'authorize:media-delete',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(DeletesRequest $request)
    {
        $args = $request->validated();

        $media = $this->useCase->media($args);

        $filtered = $media->filter(function ($item) use ($request) {
            return $request->user()->can('delete', $item);
        });

        try {
            return $this->useCase->excute([
                'ids' => $filtered->pluck('id')->all(),
            ]);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
