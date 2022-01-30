<?php declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Entities\TransactionEntity;

interface WriteTransactionRepositoryInterface
{
    public function createTransaction(TransactionEntity $transactionEntity): array;
}
