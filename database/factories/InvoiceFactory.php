<?php

use App\Customer;
use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'customer_id' => function(Invoice $invoice) {
            if (!$invoice->customer()) {
                return factory(Customer::class)->create()->id;
            }
        },
        'is_completed' => !rand(0, 1),
        'sub_total' => function(Invoice $invoice) use ($faker) {
            if (rand(0, 1)) {
                return $faker->numberBetween(0, 999);
            }

            return null;
        }
    ];
});
