<?php

namespace App\ViewComposers\InvoiceDetails;

use App\PayRate;
use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class InvoiceDetailsEditComposer extends BaseViewComposer implements ViewComposer
{
    /**
     * @inheritdoc
     */
    public function bindData()
    {
        $rates = PayRate::forCustomer($this->view->invoice->customer)->get();

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
            'Edit details' => null                    ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        $invoiceNumber = $this->view->invoice->id;

        return "Edit details of #{$invoiceNumber}";
    }
}
