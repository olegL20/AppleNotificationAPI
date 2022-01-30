<?php declare(strict_types=1);

namespace App\Services\DataMappers;

use App\Entities\TransactionEntity;
use App\Enums\TransactionTypeEnums;
use App\Services\DataMappers\Contracts\DataMapperInterface;
use Illuminate\Http\Request;

class AppleTransactionDataMapper implements DataMapperInterface
{
    public const BUY = 'INITIAL_BUY';
    public const RENEW = 'DID_RENEW';
    public const CANCEL = 'CANCEL';
    public const FAILED_RENEW = 'DID_FAIL_TO_RENEW';

    public function makeFromRequest(Request $request): TransactionEntity
    {
        $transactionEntity = new TransactionEntity();

        switch ($request->input('notification_type')) {
            case self::BUY:
                $transactionEntity->transactionType = TransactionTypeEnums::BUY;
                break;
            case self::RENEW:
                $transactionEntity->transactionType = TransactionTypeEnums::RENEW;
                break;
            case self::CANCEL:
                $transactionEntity->transactionType = TransactionTypeEnums::CANCEL;
                break;
            case self::FAILED_RENEW:
                $transactionEntity->transactionType = TransactionTypeEnums::FAILED_RENEW;
                break;
            default:
                throw new \Exception('Not matched notification type');
        }

        $transactionEntity->userId = (int)$request->input('user_id');
        $transactionEntity->transactionId = $request->input('unified_receipt.Latest_receipt_info.transaction_id');
        $transactionEntity->expireDate = (int)$request->input('unified_receipt.Latest_receipt_info.expire_date_ms');
        $transactionEntity->subscriptionId = $request->input('unified_receipt.Latest_receipt_info.product_id');

        return $transactionEntity;
    }
}
