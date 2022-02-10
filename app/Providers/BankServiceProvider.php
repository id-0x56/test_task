<?php

namespace App\Providers;

use App\Services\Banks\GreenBank;
use App\Services\Interfaces\Bank;
use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Bank::class, GreenBank::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
