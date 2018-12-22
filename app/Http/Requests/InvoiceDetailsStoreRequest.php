<?php

namespace App\Http\Requests;

use App\Concerns\DelegatesAuthorization;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceDetailsStoreRequest extends FormRequest
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
            'time'                => [
                'required',
                'regex:/\d{2}\:\d{2}/'
            ],
            'rate_id'             => 'required|exists:pay_rates,id' ,
            'tax_percentage'      => 'required|numeric'             ,
            'description'         => 'required|string'              ,
            'task_performed_date' => 'required|date'                ,
        ];
    }
}
