<?php

namespace App\ViewComposers\PayRates;

use App\Customer;
use App\Contracts\ViewComposer;
use Illuminate\View\View;

class PayRateCreateComposer implements ViewComposer
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
