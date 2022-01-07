<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\TransactionEntity;
use App\Repositories\Contracts\ReadTransactionRepositoryInterface;
use App\Repositories\Contracts\WriteTransactionRepositoryInterface;
use Illuminate\Database\Query\Builder;

class TransactionRepository implements ReadTransactionRepositoryInterface, WriteTransactionRepositoryInterface
{
    public const TABLE = 'transactions';

    protected Builder $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder->newQuery();
    }


    public function createTransaction(TransactionEntity $transactionEntity): array
    {
        $result = $this->builder->from(self::TABLE)
            ->insert($transactionEntity->toArray());

        return [
            'success' => $result
        ];
    }
}
