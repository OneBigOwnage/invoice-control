<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Concerns\DelegatesAuthorization;

class PayRateStoreRequest extends FormRequest
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
            'description' => 'required|string'              ,
            'rate'        => 'required|numeric'             ,
            'customer_id' => 'nullable|exists:customers,id' ,
        ];
    }
}
