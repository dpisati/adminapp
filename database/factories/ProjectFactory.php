<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'name' => $faker->name,
        'code' => Str::random(6),
        'client' => $faker->name,
        'franchise' => $faker->randomElement(['Christchurch', 'Timaru', 'Hokitika', 'Nelson', 'Alexandra', 'Invercargill']),
        'status' => $faker->randomElement(['Active', 'On-Hold', 'Sold']),
        'quote' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'remember_token' => Str::random(10),
    ];
});
