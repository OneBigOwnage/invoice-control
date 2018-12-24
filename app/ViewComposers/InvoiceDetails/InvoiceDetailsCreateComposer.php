<?php

namespace App\ViewComposers\InvoiceDetails;

use App\PayRate;
use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class InvoiceDetailsCreateComposer extends BaseViewComposer implements ViewComposer
{
    /**
     * @inheritdoc
     */
    public function bindData()
    {
        $rates = PayRate::forCustomer($view->invoice->customer)->get();

        $this->view->with(
            compact('rates')
        );
    }

    /**
     * @inheritdoc
     */
    public function breadCrumbs()
    {
        $invoiceNumber = $this->view->invoice->id;
        $invoiceLink = route('invoices.show', ['invoice' => $invoiceNumber]);

        return [
            'Home'         => route('dashboard')      ,
            'Invoices'     => route('invoices.index') ,
            $invoiceNumber => $invoiceLink            ,
            'Add details'  => null                    ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        $invoiceNumber = $this->view->invoice->id;

        return "Add details to #{$invoiceNumber}";
    }
}
