<?php

namespace App\Providers;

use App\ViewComposers\Customers\CustomersCreateComposer;
use App\ViewComposers\Customers\CustomersEditComposer;
use App\ViewComposers\Customers\CustomersIndexComposer;
use App\ViewComposers\Customers\CustomersShowComposer;
use App\ViewComposers\Invoices\InvoicesEditComposer;
use App\ViewComposers\Invoices\InvoicesCreateComposer;
use App\ViewComposers\Invoices\InvoicesIndexComposer;
use App\ViewComposers\Invoices\InvoicesShowComposer;
use App\ViewComposers\InvoiceDetails\InvoiceDetailsCreateComposer;
use App\ViewComposers\InvoiceDetails\InvoiceDetailsEditComposer;
use App\ViewComposers\PayRates\PayRatesCreateComposer;
use App\ViewComposers\PayRates\PayRatesEditComposer;
use App\ViewComposers\PayRates\PayRatesIndexComposer;
use App\ViewComposers\PayRates\PayRatesShowComposer;

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
        View::composer('customers.create', CustomersCreateComposer::class);
        View::composer('customers.edit'  , CustomersEditComposer  ::class);
        View::composer('customers.index' , CustomersIndexComposer ::class);
        View::composer('customers.show'  , CustomersShowComposer  ::class);

        View::composer('invoice-details.create' , InvoiceDetailsCreateComposer::class);
        View::composer('invoice-details.edit'   , InvoiceDetailsEditComposer  ::class);

        View::composer('invoices.create' , InvoicesCreateComposer::class);
        View::composer('invoices.edit'   , InvoicesEditComposer  ::class);
        View::composer('invoices.index'  , InvoicesIndexComposer ::class);
        View::composer('invoices.show'   , InvoicesShowComposer  ::class);

        View::composer('payrates.create', PayRatesCreateComposer::class);
        View::composer('payrates.edit'  , PayRatesEditComposer  ::class);
        View::composer('payrates.index' , PayRatesIndexComposer ::class);
        View::composer('payrates.show'  , PayRatesShowComposer  ::class);
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
