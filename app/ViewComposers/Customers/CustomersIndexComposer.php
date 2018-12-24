<?php

namespace App\ViewComposers\Customers;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class CustomersIndexComposer extends BaseViewComposer implements ViewComposer
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
            'Home'      => route('dashboard') ,
            'Customers' => null               ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        return 'Customers';
    }
}
