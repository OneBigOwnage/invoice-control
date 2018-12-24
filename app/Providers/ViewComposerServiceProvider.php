<?php

namespace App\Providers;

use App\ViewComposers\PayRates\PayRateCreateComposer;
use App\ViewComposers\PayRates\PayRateEditComposer;
use App\ViewComposers\Invoices\InvoiceCreateComposer;
use App\ViewComposers\InvoiceDetails\InvoiceDetailsCreateComposer;
use App\ViewComposers\InvoiceDetails\InvoiceDetailsEditComposer;

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

        View::composer('invoice-details.create', InvoiceDetailsCreateComposer::class);
        View::composer('invoice-details.edit', InvoiceDetailsEditComposer::class);
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
