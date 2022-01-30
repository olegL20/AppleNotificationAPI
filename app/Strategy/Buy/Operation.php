<?php

declare(strict_types=1);

namespace App\Strategy\Buy;

use App\Entities\TransactionEntity;
use App\Services\Subscription\Contracts\BuyInterface;

class Operation
{
    protected BuyInterface $subscriptionService;

    public function __construct(BuyInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function handle(TransactionEntity $transactionEntity): array
    {
        return $this->subscriptionService->buy($transactionEntity);
    }
}
