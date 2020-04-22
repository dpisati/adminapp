<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Cabinet;
use App\Library;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Cabinet::class, function (Faker $faker) {
    return [
        'cabinet_id' => Library::all()->random()->id,
        'quantity' => $faker->randomDigitNotNull,
        'width' => $faker->randomDigitNotNull,
        'height' => $faker->randomDigitNotNull,
        'depth' => $faker->randomDigitNotNull,
        'type' => $faker->randomElement(['Cabinet', 'Panel'])
    ];
});
