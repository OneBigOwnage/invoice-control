<?php

use App\Invoice;
use App\InvoiceDetails;
use App\PayRate;
use Faker\Generator as Faker;

$factory->define(InvoiceDetails::class, function (Faker $faker) {
    return [
        'invoice_id' => function($invoiceDetailsData) {
            return factory(Invoice::class)->create()->id;
        },
        'rate_id' => function($invoiceDetailsData) {
            return factory(PayRate::class)->create()->id;
        },
        'hours' => $faker->numberBetween(0, 20),
        'tax_percentage' => $faker->numberBetween(1, 100)
    ];
});
