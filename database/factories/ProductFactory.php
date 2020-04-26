<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        "sku" => $faker->bothify('sku_??##??#'),
        "name" => $faker->word,
        "summary" => $faker->text,
        "price" => $faker->numberBetween($min = 25, $max = 80)
    ];
});
