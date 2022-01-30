<?php

declare(strict_types=1);

namespace App\Services\Subscription\Contracts;

use App\Entities\TransactionEntity;

interface BuyInterface
{
    public function buy(TransactionEntity $transactionEntity): array;
}
