<?php

declare(strict_types=1);

namespace App\Enums;

class TransactionTypeEnums
{
    public const BUY = 'buy';
    public const RENEW = 'renew';
    public const CANCEL = 'cancel';
    public const FAILED_RENEW = 'failedRenew';
}

