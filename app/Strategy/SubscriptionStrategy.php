<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Entities\TransactionEntity;

class SubscriptionStrategy
{
    public function handle(TransactionEntity $transactionEntity): array
    {
        return app('App\\Strategy\\' . ucfirst($transactionEntity->transactionType) . '\\Operation')->handle($transactionEntity);
    }
}
