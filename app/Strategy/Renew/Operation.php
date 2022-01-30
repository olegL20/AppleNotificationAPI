<?php

declare(strict_types=1);

namespace App\Strategy\Renew;

use App\Entities\TransactionEntity;
use App\Models\User;
use App\Services\Subscription\Contracts\RenewInterface;

class Operation
{
    protected RenewInterface $subscriptionService;

    /**
     * Operation constructor.
     * @param RenewInterface $subscriptionService
     */
    public function __construct(RenewInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function handle(TransactionEntity $transactionEntity): array
    {
        return $this->subscriptionService->renew($transactionEntity);
    }
}
