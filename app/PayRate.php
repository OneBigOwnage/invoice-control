<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayRate extends Model
{
    protected $guarded = [];

    protected $table = 'pay_rates';

    public function invoiceDetails()
    {
        return $this->belongsToMany(InvoiceDetails::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
