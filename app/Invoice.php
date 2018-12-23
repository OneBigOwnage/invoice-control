<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_completed' => 'boolean' ,
        'invoice_date' => 'date'    ,
        'paid_date'    => 'date'    ,
    ];

    public function details()
    {
        return $this->hasMany(InvoiceDetails::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function calculateTotal()
    {
        $total = 0;

        $this->details->each(function(InvoiceDetails $detail) use (&$total) {
            // $detail->sub_total would give us the formatted value, we want the raw value instead.
            // $total += $detail->getAttributes()['sub_total'];
            $total += $detail->sub_total;
        });

        $this->sub_total = $total;
    }

    public function setSubTotalAttribute($subTotal)
    {
        $this->attributes['sub_total'] = $subTotal * 100;
    }

    public function getSubTotalAttribute($subTotal)
    {
        return number_format($subTotal / 100, 2);
    }

    /**
     * Finalizes the invoice.
     * This action is only possible if:
     * - The invoice is not finalized yet;
     * - The invoice has an invoice date;
     * - The invoice has a paid date.
     *
     * If not all of the requirements are met, this method will throw an exception.
     *
     * @return void
     *
     * @throws Exception When not all requirements are met.
     */
    public function finalize()
    {
        $alreadyCompleted = $this->is_completed;
        $isDated          = !is_null($this->invoice_date);
        $isPaid           = !is_null($this->paid_date);

        if ($alreadyCompleted || !$isDated || !$isPaid) {
            throw new Exception("Not possible to finalize invoice, it is either;\n- Already completed;\n- Does not have an invoice date;\n- It is not paid yet.");
        }

        $this->is_completed = true;
    }
}
