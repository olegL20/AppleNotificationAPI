<?php

namespace App\Providers;

use App\Http\Controllers\AppleNotificationController;
use App\Repositories\Contracts\ReadTransactionRepositoryInterface;
use App\Repositories\Contracts\WriteTransactionRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Services\DataMappers\AppleTransactionDataMapper;
use App\Services\Subscription\Contracts\BuyInterface;
use App\Services\Subscription\Contracts\CancelInterface;
use App\Services\Subscription\Contracts\FailedRenewInterface;
use App\Services\Subscription\Contracts\RenewInterface;
use App\Services\Subscription\SubscriptionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BuyInterface::class, SubscriptionService::class);
        $this->app->singleton(RenewInterface::class, SubscriptionService::class);
        $this->app->singleton(FailedRenewInterface::class, SubscriptionService::class);
        $this->app->singleton(CancelInterface::class, SubscriptionService::class);

        $this->app->when(AppleNotificationController::class)
            ->needs('$dataMapper')
            ->give(AppleTransactionDataMapper::class);

        $this->app->bind(WriteTransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(ReadTransactionRepositoryInterface::class, TransactionRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
