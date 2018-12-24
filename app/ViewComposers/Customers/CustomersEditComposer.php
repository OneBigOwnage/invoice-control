<?php

namespace App\ViewComposers\Customers;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class CustomersEditComposer extends BaseViewComposer implements ViewComposer
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
        $customerLink = route('customers.show', [
            'customer' => $this->view->customer->id
        ]);

        return [
            'Home'        => route('dashboard')       ,
            'Customers'   => route('customers.index') ,
            $customerName => $customerLink            ,
            'Edit'        => null                     ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        $customerName = $this->view->customer->name;

        return "Edit {$customerName}";
    }
}
