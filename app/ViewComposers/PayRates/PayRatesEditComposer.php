<?php

namespace App\ViewComposers\PayRates;

use App\Customer;
use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class PayRatesEditComposer extends BaseViewComposer implements ViewComposer
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
        $payRate = $this->view->payRate;
        $payRateName = $payRate->description;
        $payRateLink = route('payrates.show', ['payRate' => $payRate->id]);


        if (!empty($payRate->customer)) {
            $payRateName .= " ({$payRate->customer->name})";
        }

        return [
            'Home'       => route('dashboard')      ,
            'Pay rates'  => route('payrates.index') ,
            $payRateName => $payRateLink            ,
            'Edit'       => null                    ,
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
            return "Edit pay rate {$description} of {$customer->name}";
        }

        return "Edit pay rate {$description}";
    }
}
