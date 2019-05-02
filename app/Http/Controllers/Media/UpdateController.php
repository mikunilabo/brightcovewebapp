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
            'authenticate',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param string $videoId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(string $videoId)
    {
        $media = $this->useCase->media($videoId);

//         $this->authorize('select', $media);// TODO

        $ingestjobs = $this->useCase->ingestjobs($videoId);

        return view('media.detail', [
            'row' => $media,
            'ingestjobs' => $ingestjobs,
        ]);
    }

    /**
     * @param ValidatesWhenResolved $request
     * @param string $videoId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(UpdateRequest $request, string $videoId)
    {
        $media = $this->useCase->media($videoId);

//         $this->authorize('update', $media);// TODO

        $args = $request->validated();

        $callback = function () use ($videoId, $args) {
            $this->useCase->excute([
                'id' => $videoId,
                'param'  => $args,
            ]);
        };

        if (! is_null(rescue($callback, false))) {
            return back()
                ->with('alerts.danger', [__('An internal server error has occurred. Please contact the administrator.')])
                ->withInput();
        }

        return redirect()
            ->route('media.detail', $videoId)
            ->with('alerts.success', [__('The :name information was :action.', ['name' => __('Media'), 'action' => __('Update')])]);
    }
}
