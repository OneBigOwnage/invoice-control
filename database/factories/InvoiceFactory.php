<?php

use App\Customer;
use App\Invoice;
use App\InvoiceDetails;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

/**
 * @var Factory $factory
 */
$factory;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'customer_id' => function($invoiceData) {
            return factory(Customer::class)->create()->id;
        },
        'is_completed' => false,
        'sub_total' => null
    ];
});

$factory->afterCreatingState(Invoice::class, 'completed', function (Invoice $invoice, Faker $faker) {
    $details = factory(InvoiceDetails::class, $faker->numberBetween(1, 9))->make();

    $invoice->details()->saveMany($details);

    $invoice->is_completed = true;
});
