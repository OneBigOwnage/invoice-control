<?php

namespace App\ViewComposers\Invoices;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class InvoicesEditComposer extends BaseViewComposer implements ViewComposer
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
        $invoiceNumber = $this->view->invoice->id;
        $invoiceLink   = route('invoices.show', ['invoice' => $invoiceNumber]);

        return [
            'Home'         => route('dashboard')      ,
            'Invoices'     => route('invoices.index') ,
            $invoiceNumber => $invoiceLink            ,
            'Edit'         => null                    ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        $invoiceNumber = $this->view->invoice->id;

        return "Edit invoice #{$invoiceNumber}";
    }
}
