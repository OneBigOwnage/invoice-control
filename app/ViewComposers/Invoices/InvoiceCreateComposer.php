<?php

namespace App\ViewComposers\Invoices;

use App\Customer;
use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;
use Illuminate\View\View;

class InvoiceCreateComposer extends BaseViewComposer implements ViewComposer
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
            'Invoices'   => route('invoices.index') ,
            'Create new' => null                    ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        return 'New invoice';
    }
}
