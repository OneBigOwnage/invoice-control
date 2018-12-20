<?php

use App\Customer;
use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'customer_id' => function($invoiceData) {
            return factory(Customer::class)->create()->id;
        },
        'is_completed' => !rand(0, 1),
        'sub_total' => function($invoiceData) use ($faker) {
            if (rand(0, 1)) {
                return $faker->numberBetween(0, 999);
            }

            return null;
        }
    ];
});
