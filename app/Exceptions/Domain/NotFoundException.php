<?php
declare(strict_types=1);

namespace App\Exceptions\Domain;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class NotFoundException extends \Exception implements DomainException
{
    /**
     * @return void
     */
    public function report()
    {
        // Non report.
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        throw new NotFoundHttpException;
    }
}
