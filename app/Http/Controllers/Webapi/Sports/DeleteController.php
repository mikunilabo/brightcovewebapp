<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Sports;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\UseCases\Sports\DeleteSport;

final class DeleteController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param DeleteSport $useCase
     * @return void
     */
    public function __construct(DeleteSport $useCase)
    {
        $this->middleware([
            'authorize:user-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param int $sportId
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(int $sportId)
    {
        $league = $this->useCase->sport($sportId);

//         $this->authorize('delete', $league);// TODO

        try {
            return $this->useCase->excute([
                'id' => $sportId,
            ]);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
