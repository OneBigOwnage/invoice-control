<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * All related invoice details.
     */
    public function invoiceDetails()
    {
        return $this->belongsToMany(InvoiceDetails::class);
    }

    /**
     * The customer that this pay rate belongs to.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Custom query scope to scope the query to a specific customer.
     */
    public function scopeForCustomer(Builder $builder, Customer $customer)
    {
        return $builder
            ->where('customer_id', $customer->id)
            ->orWhereNull('customer_id');
    }
}
