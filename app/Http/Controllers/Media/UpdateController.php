<?php
declare(strict_types=1);

namespace App\Http\Controllers\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\UpdateRequest;
use App\UseCases\Media\UpdateMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

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
            'authorize:media-select',
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

        $this->authorize('select', $media);

        return view('media.detail', [
            'row' => $media,
        ]);
    }
}
