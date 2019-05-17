<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Media\DeactivatesRequest;
use App\UseCases\Media\DeactivatesMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class DeactivatesController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param DeactivatesMedia $useCase
     * @return void
     */
    public function __construct(DeactivatesMedia $useCase)
    {
        $this->middleware([
            'authenticate',
            'authorize:media-update',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(DeactivatesRequest $request)
    {
        $args = $request->validated();

        $media = $this->useCase->media($args);

        $filtered = $media->filter(function ($item) use ($request) {
            return $request->user()->can('update', $item);
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
