<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Finish;
use Faker\Generator as Faker;

$factory->define(Finish::class, function (Faker $faker) {
    return [
        'supplier_id' => factory(App\Supplier::class),
        'name' => $faker->name,
    ];
});
