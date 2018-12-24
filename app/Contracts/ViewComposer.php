<?php

namespace App\Contracts;

use Illuminate\View\View;


interface ViewComposer {
    /**
     * Bind data to the view.
     *
     * @param View $view The view that is about to be rendered.
     *
     * @return void
     */
    public function compose(View $view);
}
