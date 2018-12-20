<?php

use App\PayRate;
use Faker\Generator as Faker;
use App\Customer;

$factory->define(PayRate::class, function (Faker $faker) {
    return [
        'customer_id' => function($payRateData) {
            return factory(Customer::class)->create()->id;
        },
        'rate' => $faker->randomFloat(2, 1, 50),
        'description' => $faker->sentence(),
    ];
});
