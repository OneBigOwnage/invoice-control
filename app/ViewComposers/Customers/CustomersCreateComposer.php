<?php

namespace App\ViewComposers\Customers;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class CustomersCreateComposer extends BaseViewComposer implements ViewComposer
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
        return [
            'Home'       => route('dashboard')       ,
            'Customers'  => route('customers.index') ,
            'Create new' => null                     ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        return 'Create new customer';
    }
}
