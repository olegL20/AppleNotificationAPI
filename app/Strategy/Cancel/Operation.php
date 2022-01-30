<?php

declare(strict_types=1);

namespace App\Strategy\Cancel;

use App\Entities\TransactionEntity;
use App\Models\User;
use App\Services\Subscription\Contracts\CancelInterface;

class Operation
{
    protected CancelInterface $subscriptionService;

    public function __construct(CancelInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function handle(TransactionEntity $transactionEntity): array
    {
        return $this->subscriptionService->cancel($transactionEntity);
    }
}
