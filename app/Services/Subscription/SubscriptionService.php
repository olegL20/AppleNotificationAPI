<?php

declare(strict_types=1);

namespace App\Services\Subscription;

use App\Entities\TransactionEntity;
use App\Models\User;
use App\Repositories\Contracts\WriteTransactionRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Services\Subscription\Contracts\BuyInterface;
use App\Services\Subscription\Contracts\CancelInterface;
use App\Services\Subscription\Contracts\FailedRenewInterface;
use App\Services\Subscription\Contracts\RenewInterface;
use App\Services\UserService;

class SubscriptionService implements BuyInterface, RenewInterface, CancelInterface, FailedRenewInterface
{
    protected WriteTransactionRepositoryInterface $transactionRepository;

    protected UserService $userService;

    /**
     * SubscriptionService constructor.
     * @param WriteTransactionRepositoryInterface $transactionRepository
     * @param UserService $userService
     */
    public function __construct(
        WriteTransactionRepositoryInterface $transactionRepository,
        UserService $userService
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->userService = $userService;
    }


    public function buy(TransactionEntity $transactionEntity): array
    {

        $result = $this->transactionRepository->createTransaction($transactionEntity);

        $this->userService->attachToken(
            $transactionEntity->userId,
            [
                'subscription:can_use'
            ]
        );

        return $result;
    }

    public function cancel(TransactionEntity $transactionEntity): array
    {
        return $this->transactionRepository->createTransaction($transactionEntity);
    }

    public function renew(TransactionEntity $transactionEntity): array
    {

        $result = $this->transactionRepository->createTransaction($transactionEntity);
        $this->userService->attachToken(
            $transactionEntity->userId,
            [
                'subscription:can_use'
            ]
        );

        return $result;
    }

    public function failedRenew(TransactionEntity $transactionEntity): array
    {
        $result = $this->transactionRepository->createTransaction($transactionEntity);
        $this->userService->revokeTokens($transactionEntity->userId);

        return $result;
    }
}
