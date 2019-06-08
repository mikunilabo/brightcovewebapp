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
            'authorize:user-create',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param int $universityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(int $universityId)
    {
        $league = $this->useCase->university($universityId);

        $this->authorize('delete', $league);

        return $this->useCase->excute([
            'id' => $universityId,
        ]);
    }
}
