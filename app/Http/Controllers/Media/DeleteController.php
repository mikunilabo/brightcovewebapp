<?php
declare(strict_types=1);

namespace App\Http\Controllers\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\UseCases\Media\DeleteMedia;

final class DeleteController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param DeleteMedia $useCase
     * @return void
     */
    public function __construct(DeleteMedia $useCase)
    {
        $this->middleware([
            'authenticate',
            'authorize:media-delete',
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

        $this->authorize('delete', $media);

        $callback = function () use ($videoId) {
            $this->useCase->excute([
                'id' => $videoId,
            ]);
        };

        if (! is_null(rescue($callback, false))) {
            return back()
                ->with('alerts.danger', [__('An internal server error has occurred. Please contact the administrator.')])
                ->withInput();
        }

        return redirect()
            ->route('media.index')
            ->with('alerts.info', [__('The :name information was :action.', ['name' => __('Media'), 'action' => __('Delete')])]);
    }
}
