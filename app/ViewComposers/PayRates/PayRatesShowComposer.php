<?php

namespace App\ViewComposers\PayRates;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class PayRatesShowComposer extends BaseViewComposer implements ViewComposer
{
    /**
     * @inheritdoc
     */
    public function bindData()
    {
        //
    }

    /**
     * @inheritdoc
     */
    public function breadCrumbs()
    {
        $payRate = $this->view->payRate;
        $payRateName = $payRate->description;

        if (!empty($payRate->customer)) {
            $payRateName .= " ({$payRate->customer->name})";
        }

        return [
            'Home'       => route('dashboard')      ,
            'Pay rates'  => route('payrates.index') ,
            $payRateName => null                    ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        $customer = $this->view->payRate->customer;
        $description = $this->view->payRate->description;

        if (!empty($customer)) {
            return "Pay rate {$description} for {$customer->name}";
        }

        return "Pay rate {$description}";
    }
}
