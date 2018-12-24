<?php

namespace App\ViewComposers\Invoices;

use App\Customer;
use App\Contracts\ViewComposer;
use Illuminate\View\View;

class InvoiceCreateComposer implements ViewComposer
{
    /**
     * @inheritdoc
     */
    public function compose(View $view)
    {
        $customers = Customer::all();

        $view->with(
            compact('customers')
        );
    }
}
