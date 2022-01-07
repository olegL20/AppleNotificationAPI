<?php

declare(strict_types=1);

namespace App\Services\Subscription\Contracts;

use App\Entities\TransactionEntity;

interface FailedRenewInterface
{
    public function failedRenew(TransactionEntity $transactionEntity): array;
}
