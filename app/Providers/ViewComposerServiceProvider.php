<?php

namespace App\Providers;

use App\ViewComposers\Customers\CustomersCreateComposer;
use App\ViewComposers\Customers\CustomersEditComposer;
use App\ViewComposers\Customers\CustomersIndexComposer;
use App\ViewComposers\Customers\CustomersShowComposer;

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
