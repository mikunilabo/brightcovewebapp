<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Contracts\Domain\RepositoryContract;
use Illuminate\View\View;

final class RolesComposer
{
    /** @var RepositoryContract */
    private $repo;

    /**
     * @param RepositoryContract $repo
     * @return void
     */
    public function __construct(RepositoryContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function create(View $view)
    {
        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    private function excute(View $view)
    {
        $view->with('vc_roles', $this->repo->findAll());
    }

}
