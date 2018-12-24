<?php

namespace App\Providers;

use App\ViewComposers\Customers\CustomersCreateComposer;
use App\ViewComposers\Customers\CustomersEditComposer;
use App\ViewComposers\Customers\CustomersIndexComposer;
use App\ViewComposers\Customers\CustomersShowComposer;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\InvoiceDetails\InvoiceDetailsCreateComposer;
use App\ViewComposers\InvoiceDetails\InvoiceDetailsEditComposer;
use App\ViewComposers\Invoices\InvoicesEditComposer;
use App\ViewComposers\Invoices\InvoicesCreateComposer;
use App\ViewComposers\Invoices\InvoicesIndexComposer;
use App\ViewComposers\Invoices\InvoicesShowComposer;

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
