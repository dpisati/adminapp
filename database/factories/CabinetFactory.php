<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Cabinet;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Cabinet::class, function (Faker $faker) {
    return [
        'category' => $faker->randomElement(['Base', 'On-Bench', 'Tall', 'Wall']),
        'subcategory' => $faker->randomElement(['Opening', 'Corner', 'Accessories']),
        'measure_type' => $faker->randomElement(['Single', 'Parametric', 'Multiple']),
        'name' => $faker->name
    ];
});
