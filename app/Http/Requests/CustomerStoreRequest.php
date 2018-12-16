<?php

namespace App\Http\Requests;

use App\Concerns\DelegatesAuthorization;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    use DelegatesAuthorization;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string'
        ];
    }
}
