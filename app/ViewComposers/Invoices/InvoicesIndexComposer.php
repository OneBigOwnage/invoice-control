<?php

namespace App\ViewComposers\Invoices;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class InvoicesIndexComposer extends BaseViewComposer implements ViewComposer
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
            'Home'     => route('dashboard') ,
            'Invoices' => null               ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        return 'Invoices';
    }
}
