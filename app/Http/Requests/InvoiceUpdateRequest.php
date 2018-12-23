<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Concerns\DelegatesAuthorization;

class InvoiceUpdateRequest extends FormRequest
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
            'invoice_date' => 'nullable|date',
            'paid_date'    => 'nullable|date',
        ];
    }
}
