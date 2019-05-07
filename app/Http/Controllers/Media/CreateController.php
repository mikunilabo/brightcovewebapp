<?php
declare(strict_types=1);

namespace App\Http\Controllers\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\CreateRequest;
use App\UseCases\Media\CreateMedia;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class CreateController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param CreateMedia $useCase
     * @return void
     */
    public function __construct(CreateMedia $useCase)
    {
        $this->middleware([
            'authenticate',
            'authorize:media-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view()
    {
        return view('media.upload');
    }

    /**
     * @param ValidatesWhenResolved $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(CreateRequest $request)
    {
        $args = $request->validated();
        $args['uuid'] = $request->user()->id;
        $args['name'] = 'test';

        $callback = function () use ($args) {
            return $this->useCase->excute([
                'param' => $args,
            ]);
        };

        if (($result = rescue($callback, false)) === false) {
            return back()
                ->with('alerts.danger', [__('An internal server error has occurred. Please contact the administrator.')])
                ->withInput();
        }

        return redirect()
            ->route('media.detail', $result->id)
            ->with('alerts.success', [__('The :name information was :action.', ['name' => __('Media'), 'action' => __('Upload')])]);
    }
}
