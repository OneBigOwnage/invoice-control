<?php

namespace App\Providers;

use App\ViewComposers\PayRates\PayRateCreateComposer;
use App\ViewComposers\PayRates\PayRateEditComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('payrates.create', PayRateCreateComposer::class);
        View::composer('payrates.edit', PayRateEditComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
