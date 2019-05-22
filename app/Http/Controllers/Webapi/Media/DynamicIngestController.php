<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Media\DynamicIngestRequest;
use App\UseCases\Media\ingestMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class DynamicIngestController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param ingestMedia $useCase
     * @return void
     */
    public function __construct(ingestMedia $useCase)
    {
        $this->middleware([
            'authorize:media-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @param string $videoId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(DynamicIngestRequest $request, string $videoId)
    {
        $args = $request->validated();
        $args['profile'] = config('services.videocloud.video_profile');

        try {
            return $this->useCase->excute([
                'id' => $videoId,
                'param' => $args,
            ]);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
