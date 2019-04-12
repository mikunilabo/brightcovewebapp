<?php
declare(strict_types=1);

namespace App\Traits\Database;

use App\Contracts\Database\TransactionableContract;

trait Transactionable
{
    /**
     * @param callable $callee
     * @return mixed
     */
    public function transaction(callable $callee)
    {
        return app(TransactionableContract::class)->transaction($callee);
    }

}
