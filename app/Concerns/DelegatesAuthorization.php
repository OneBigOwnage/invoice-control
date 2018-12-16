<?php

namespace App\Concerns;

/**
 * Automatically returns true on the authorize method.
 * So that the actual authorization can be handled in another part of the application.
 */
trait DelegatesAuthorization
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
