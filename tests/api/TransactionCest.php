<?php

use Codeception\Example;
use Faker\Factory;

class TransactionCest
{
    public function _before(ApiTester $I)
    {
    }

    /**
     * @dataProvider buyData
     * @param ApiTester $I
     * @param Example $example
     */
    public function testTransaction(ApiTester $I, Example $example)
    {
        $I->sendPost('api/subscription', $example['request']);
        $I->seeResponseIsJson();
        $I->canSeeResponseContainsJson(['success' => true]);
    }

    protected function buyData(): array
    {
        return [
            'buy' => [
                'request' => [
                    'user_id' => 1,
                    'notification_type' => 'INITIAL_BUY',
                    'unified_receipt' => [
                        'expire_date_ms' => time(),
                        'transaction_id' => Factory::create()->md5,
                        'product_id' => Factory::create()->word,
                    ]
                ]
            ],
            'renew' => [
                'request' => [
                    'user_id' => 1,
                    'notification_type' => 'DID_RENEW',
                    'unified_receipt' => [
                        'expire_date_ms' => time(),
                        'transaction_id' => Factory::create()->md5,
                        'product_id' => Factory::create()->word,
                    ]
                ]
            ],
            'cancel' => [
                'request' => [
                    'user_id' => 1,
                    'notification_type' => 'CANCEL',
                    'unified_receipt' => [
                        'expire_date_ms' => time(),
                        'transaction_id' => Factory::create()->md5,
                        'product_id' => Factory::create()->word,
                    ]
                ]
            ],
            'failed_renew' => [
                'request' => [
                    'user_id' => 1,
                    'notification_type' => 'DID_FAIL_TO_RENEW',
                    'unified_receipt' => [
                        'expire_date_ms' => time(),
                        'transaction_id' => Factory::create()->md5,
                        'product_id' => Factory::create()->word,
                    ]
                ]
            ],
        ];
    }
}
