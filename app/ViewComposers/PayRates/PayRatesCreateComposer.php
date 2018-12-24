<?php

namespace App\ViewComposers\PayRates;

use App\Customer;
use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class PayRatesCreateComposer extends BaseViewComposer implements ViewComposer
{
    /**
     * @inheritdoc
     */
    public function bindData()
    {
        $customers = Customer::all();

        $this->view->with(
            compact('customers')
        );
    }

    /**
     * @inheritdoc
     */
    public function breadCrumbs()
    {
        return [
            'Home'       => route('dashboard')      ,
            'Pay rates'  => route('payrates.index') ,
            'Create new' => null                    ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        return 'Create new pay rate';
    }
}
