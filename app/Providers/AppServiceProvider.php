<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Observers\TransactionObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register our observers
        $this->registerObservers();
    }

    /**
     * A separate function to register our observers to keep boot clean
     */
    public function registerObservers()
    {
        Transaction::observe(TransactionObserver::class);
    }
}
