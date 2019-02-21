<?php

namespace App\ViewComposers\PayRates;

use App\Contracts\ViewComposer;
use App\ViewComposers\ViewComposer as BaseViewComposer;

class PayRatesIndexComposer extends BaseViewComposer implements ViewComposer
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
            'Pay rates' => null               ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function title()
    {
        return 'Pay rates';
    }
}
