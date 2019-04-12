<?php
declare(strict_types=1);

namespace App\Contracts\Database;

interface TransactionableContract
{
    /**
     * @param callable $callee
     * @return mixed
     */
    public function transaction(callable $callee);
}
