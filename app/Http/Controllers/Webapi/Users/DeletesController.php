<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webapi\Users\DeletesRequest;
use App\UseCases\Users\DeletesUsers;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class DeletesController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param DeletesUsers $useCase
     * @return void
     */
    public function __construct(DeletesUsers $useCase)
    {
        $this->middleware([
            'authorize:user-delete',
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

        $users = $this->useCase->users($args);

        $filtered = $users->filter(function ($item) use ($request) {
            return $request->user()->can('delete', $item);
        });

        try {
            return $this->useCase->excute([
                'items' => $filtered->values(),
            ]);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
