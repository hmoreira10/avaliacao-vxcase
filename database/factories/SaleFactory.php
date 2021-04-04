<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'purchase_at' => Carbon\Carbon::now()
    ];
});
