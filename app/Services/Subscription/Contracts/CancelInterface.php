<?php

declare(strict_types=1);

namespace App\Services\Subscription\Contracts;

use App\Entities\TransactionEntity;

interface CancelInterface
{
    public function cancel(TransactionEntity $transactionEntity): array;
}
