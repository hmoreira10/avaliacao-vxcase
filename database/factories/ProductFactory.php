<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->bothify(strtoupper('product-' . $faker->word)),
        'reference' => $faker->bothify('VX-#####'),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 1000),
        'delivery_days' => $faker->numberBetween($min = 5, $max = 60)

    ];
});
