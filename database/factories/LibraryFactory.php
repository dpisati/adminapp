<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Library;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Library::class, function (Faker $faker) {
    return [
        'category' => $faker->randomElement(['Base', 'On-Bench', 'Tall', 'Wall']),
        'subcategory' => $faker->randomElement(['Opening', 'Corner', 'Accessories']),
        'measure_type' => $faker->randomElement(['Single', 'Parametric', 'Multiple']),
        'name' => $faker->name,
        'type' => $faker->randomElement(['Cabinet', 'Panel'])
    ];
});
