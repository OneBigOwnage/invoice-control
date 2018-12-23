<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $guarded = [];

    protected $casts = [
        'task_performed_date' => 'date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (InvoiceDetails $details) {
            $details->setSubTotal();
        });

        static::saved(function (InvoiceDetails $details)
        {
            $details->invoice->calculateTotal();
            $details->invoice->save();
        });
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function rate()
    {
        return $this->belongsTo(PayRate::class);
    }

    public function setSubTotal()
    {
        $rate    = $this->rate->rate;
        $hours   = intval(substr($this->formatted_time, 0, 2));
        $minutes = intval(substr($this->formatted_time, -2));

        $time = $hours + ($minutes / 60);

        $this->sub_total = $time * $rate;
    }

    public function setSubTotalAttribute($subTotal)
    {
        $this->attributes['sub_total'] = $subTotal * 100;
    }

    public function getSubTotalAttribute($subTotal)
    {
        return number_format($subTotal / 100, 2);
    }

    public function getFormattedTimeAttribute()
    {
        if (is_null($this->minutes)) {
            return null;
        }

        // Derive hours from minutes,
        // then pad with a leading zero if necessary.
        $hours = intval(floor($this->minutes / 60));
        $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);

        // Derive the remaining minutes from the total minutes,
        // then pad with a leading zero if necessary.
        $minutes = intval($this->minutes - ($hours * 60));
        $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);

        return sprintf('%s:%s', $hours, $minutes);
    }

    /**
     * Method to set the number of minutes on this object, as derived from the given timestring.
     * The timestring should be formatted as follows: HH:MM.
     *
     * @param string $timeString A string in the format HH:MM, depicting a time value.
     *
     * @return void
     *
     * @throws Exception When the given timestring is not in a valid format.
     */
    public function setMinutesFromTimeString($timeString)
    {
        if (preg_match('/\d\d:\d\d/', $timeString) !== 1) {
            throw new Exception("'{$timeString}' is not a valid time string. Format should be 'HH:MM'.");
        }

        $hours = substr($timeString, 0, 2);
        $minutes = substr($timeString, -2);

        $this->minutes = $minutes + (60 * $hours);
    }
}
