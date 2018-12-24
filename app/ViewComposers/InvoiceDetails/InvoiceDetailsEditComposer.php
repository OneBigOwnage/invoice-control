<?php

namespace App\ViewComposers\InvoiceDetails;

use App\PayRate;
use App\Contracts\ViewComposer;
use Illuminate\View\View;

class InvoiceDetailsEditComposer implements ViewComposer
{
    public function compose(View $view)
    {
        $rates = PayRate::forCustomer($view->invoice->customer)->get();

        $view->with(
            compact('rates')
        );
    }
}
