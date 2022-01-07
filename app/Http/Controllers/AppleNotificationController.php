<?php

namespace App\Http\Controllers;

use App\Services\DataMappers\Contracts\DataMapperInterface;
use App\Strategy\SubscriptionStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppleNotificationController extends Controller
{
    protected DataMapperInterface $dataMapper;

    protected SubscriptionStrategy $subscriptionStrategy;

    /**
     * SubscriptionController constructor.
     * @param DataMapperInterface $dataMapper
     * @param SubscriptionStrategy $subscriptionStrategy
     */
    public function __construct(
        DataMapperInterface $dataMapper,
        SubscriptionStrategy $subscriptionStrategy
    ) {
        $this->dataMapper = $dataMapper;
        $this->subscriptionStrategy = $subscriptionStrategy;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $transactionEntity = $this->dataMapper->makeFromRequest($request);

        return new JsonResponse(
            [
                $this->subscriptionStrategy->handle($transactionEntity),
            ]
        );
    }
}
