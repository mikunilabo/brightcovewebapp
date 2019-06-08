<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Media\UpdateRequest;
use App\UseCases\Media\UpdateMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use function Illuminate\Foundation\Testing\Concerns\report;

final class UpdateController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param UpdateMedia $useCase
     * @return void
     */
    public function __construct(UpdateMedia $useCase)
    {
        $this->middleware([
            'authorize:media-update',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @param string $videoId
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UpdateRequest $request, string $videoId)
    {
        $media = $this->useCase->media($videoId);

        $this->authorize('update', $media);

        $args = $request->validated();

        return $this->useCase->excute([
            'id' => $videoId,
            'param' => $args,
        ]);
    }
}
