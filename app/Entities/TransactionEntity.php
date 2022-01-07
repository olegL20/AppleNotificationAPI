<?php

declare(strict_types=1);

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

class TransactionEntity implements Arrayable
{
    public int $id;

    public int $userId;

    public string $subscriptionId;

    public string $transactionId;

    public int $expireDate;

    public string $transactionType;

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'subscription_id' => $this->subscriptionId,
            'transaction_id' => $this->transactionId,
            'expire_date' => $this->expireDate,
            'transaction_type' => $this->transactionType,
        ];
    }
}
