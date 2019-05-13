<?php
declare(strict_types=1);

namespace App\Http\Controllers\Webapi\Universities;

use App\Contracts\Domain\UseCaseContract;
use App\Http\Controllers\Controller;
use App\UseCases\Universities\DeleteUniversity;

final class DeleteController extends Controller
{
    /** @var UseCaseContract */
    private $useCase;

    /**
     * @param DeleteUniversity $useCase
     * @return void
     */
    public function __construct(DeleteUniversity $useCase)
    {
        $this->middleware([
            'authenticate',
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
