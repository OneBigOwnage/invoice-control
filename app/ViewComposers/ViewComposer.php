<?php

namespace App\ViewComposers;

use Illuminate\View\View;

class ViewComposer
{
    /**
     * @var View $view
     */
    protected $view;

    /**
     * This method will bind the breadcrumbs and title to the view.
     * After that it calls the bindData method, which may be used
     * to bind any other data to the view.
     *
     * @param View $view The view that is to be composed.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $this->view = $view;

        $this->view->with(
            'breadCrumbs', $this->breadCrumbs()
        );

        $this->view->with(
            'title', $this->title()
        );

        $this->bindData();
    }
}
