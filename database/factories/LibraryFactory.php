<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Library;
use App\SubCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Library::class, function (Faker $faker) {
    return [
        'sub_category_id' => $faker->randomElement([1, 2, 3]),
        'measure_type' => $faker->randomElement(['Single', 'Parametric', 'Multiple']),
        'type' => $faker->randomElement(['Cabinet', 'Panel']),
        'name' => $faker->name,
        'min_width' => 600,
        'max_width' => 1200,
        'min_height' => 720,
        'max_height' => 870,
        'min_depth' => 578,
        'max_depth' => 598,
    ];
});
