<?php

declare(strict_types=1);

namespace App\Strategy\FailedRenew;

use App\Entities\TransactionEntity;
use App\Models\User;
use App\Services\Subscription\Contracts\FailedRenewInterface;

class Operation
{
    protected FailedRenewInterface $subscriptionService;

    /**
     * Operation constructor.
     * @param FailedRenewInterface $subscriptionService
     */
    public function __construct(FailedRenewInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function handle(TransactionEntity $transactionEntity): array
    {
        return $this->subscriptionService->failedRenew($transactionEntity);
    }
}
