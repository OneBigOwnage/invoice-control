<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_completed' => 'boolean'
    ];

    public function details()
    {
        return $this->hasMany(InvoiceDetails::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
