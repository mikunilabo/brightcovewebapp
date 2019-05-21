<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Leagues;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\UseCases\Leagues\DeleteLeague;

final class DeleteController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param DeleteLeague $useCase
     * @return void
     */
    public function __construct(DeleteLeague $useCase)
    {
        $this->middleware([
            'authorize:user-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param int $leagueId
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(int $leagueId)
    {
        $league = $this->useCase->league($leagueId);

//         $this->authorize('delete', $league);// TODO

        try {
            return $this->useCase->excute([
                'id' => $leagueId,
            ]);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
