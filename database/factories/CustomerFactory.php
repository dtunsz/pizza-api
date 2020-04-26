<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        //

        "name" => $faker->word,
        "email" => $faker->email,
        "phone" => $faker->phoneNumber,
        "orderId" => $faker->bothify('??##??#'),
        "houseNumber" => $faker->randomDigit,
        "streetName" => $faker->streetName,
        "city" => $faker->city,
        "orderPriceEur" => $faker->numberBetween($min = 99, $max = 500),
        "orderPriceUsd" => $faker->numberBetween($min = 150, $max = 800)


    ];
});
