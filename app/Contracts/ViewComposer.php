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

    /**
     * Retrieves the breadcrumbs for the current page.
     *
     * @return array The breadcrumbs for the page.
     */
    public function breadCrumbs();

    /**
     * Retrieves the title of the page.
     *
     * @return string The title of the page.
     */
    public function title();
}
