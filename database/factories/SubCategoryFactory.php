<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SubCategory;
use App\Category;
use Faker\Generator as Faker;

$factory->define(SubCategory::class, function (Faker $faker) {
    return [
        'category_id' => factory(App\Category::class),
        'name' => $faker->name
    ];
});
