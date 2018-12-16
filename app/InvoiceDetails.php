<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function rate()
    {
        return $this->hasOne(PayRate::class);
    }
}
