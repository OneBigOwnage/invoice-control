<?php

namespace App\ViewComposers\Invoices;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class InvoicesShowComposer extends BaseViewComposer implements ViewComposer
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

        return [
            'Home'         => route('dashboard')      ,
            'Invoices'     => route('invoices.index') ,
            $invoiceNumber => null                    ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        $invoiceNumber = $this->view->invoice->id;

        return "Invoice #{$invoiceNumber}";
    }
}
