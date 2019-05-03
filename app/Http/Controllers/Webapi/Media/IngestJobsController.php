<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\UseCases\Media\GetIngestJobs;

final class IngestJobsController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param GetIngestJobs $useCase
     * @return void
     */
    public function __construct(GetIngestJobs $useCase)
    {
        $this->middleware([
            'authenticate',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param string $videoId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(string $videoId)
    {
        $media = $this->useCase->media($videoId);

//         $this->authorize('select', $media);// TODO

        try {
            return $this->useCase->excute([
                'id' => $videoId,
            ]);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
