<?php

namespace App\ViewComposers\Customers;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class CustomersShowComposer extends BaseViewComposer implements ViewComposer
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
        $customerName = $this->view->customer->name;

        return [
            'Home'        => route('dashboard')       ,
            'Customers'   => route('customers.index') ,
            $customerName => null                     ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        return $this->view->customer->name;
    }
}
