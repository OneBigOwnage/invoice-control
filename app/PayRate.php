<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayRate extends Model
{
    protected $guarded = [];

    protected $table = 'pay_rates';

    /**
     * The rate is stored in cents, so it needs to be devided by 100
     * when retrieved from the database.
     *
     * @param Integer $rate The raw hourly pay rate from the database.
     *
     * @return Integer|Float The hourly pay rate in euros.
     */
    public function getRateAttribute($rate)
    {
        return number_format($rate / 100, 2);
    }

    /**
     * The rate is stored in cents, so it needs to be multiplied
     * by 100 before storing it into the database.
     *
     * @param Integer|Float $rate The hourly pay rate in euros.
     */
    public function setRateAttribute($rate)
    {
        $this->attributes['rate'] = $rate * 100;
    }

    public function invoiceDetails()
    {
        return $this->belongsToMany(InvoiceDetails::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
