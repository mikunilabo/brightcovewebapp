<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Media\GetS3UrlRequest;
use App\UseCases\Media\GetS3Url;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class GetS3UrlController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param GetS3Url $useCase
     * @return void
     */
    public function __construct(GetS3Url $useCase)
    {
        $this->middleware([
            'authorize:media-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ValidatesWhenResolved $request
     * @param string $videoId
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(GetS3UrlRequest $request, string $videoId)
    {
        $args = $request->validated();

        return $this->useCase->excute([
            'id' => $videoId,
            'param' => $args,
        ]);
    }
}
