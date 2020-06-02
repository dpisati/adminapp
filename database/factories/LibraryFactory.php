<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Library;
use App\SubCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Library::class, function (Faker $faker) {
    $name = $faker->name;
    $slug = Str::slug($name, '-');
    return [
        'sub_category_id' => factory(App\SubCategory::class),
        'measure_type' => $faker->randomElement(['Single', 'Parametric', 'Multiple']),
        'type' => $faker->randomElement(['Cabinet', 'Panel']),
        'name' => $name,
        'slug' => $slug,
        'min_width' => 600,
        'max_width' => 1200,
        'min_height' => 720,
        'max_height' => 870,
        'min_depth' => 578,
        'max_depth' => 598,
    ];
});
