<?php

namespace App\Providers;

use App\ViewComposers\PayRates\PayRateCreateComposer;
use App\ViewComposers\PayRates\PayRateEditComposer;
use App\ViewComposers\Invoices\InvoiceCreateComposer;

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

        View::composer('invoices.create', InvoiceCreateComposer::class);
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
