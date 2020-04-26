<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        //
        "orderId" => $faker->bothify('??##??#'),
        "productName" => $faker->word,
        "productPrice" => $faker->numberBetween($min = 1, $max = 20),
        "quantity" => $faker->numberBetween($min = 1, $max = 20)
    ];
});
