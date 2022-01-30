<?php

declare(strict_types=1);

namespace App\Services\Subscription\Contracts;

use App\Entities\TransactionEntity;

interface RenewInterface
{
    public function renew(TransactionEntity $transactionEntity): array;
}
