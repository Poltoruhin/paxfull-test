<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\BtcPriceProvider;
use App\Services\CurrencyExchangeHelper;
use App\Services\MoneyFormatter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        BtcPriceProvider::class => BtcPriceProvider::class,
        CurrencyExchangeHelper::class => CurrencyExchangeHelper::class,
        MoneyFormatter::class => MoneyFormatter::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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
