<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

// $factory->define(User::class, function (Faker $faker) {
//     return [
//         'name' => $faker->name,
//         'type' => 'user',
//         'franchise' => $faker->randomElement(['Christchurch', 'Timaru', 'Hokitika', 'Nelson', 'Alexandra', 'Invercargill']),
//         'email' => $faker->unique()->safeEmail,
//         'email_verified_at' => now(),
//         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//         'remember_token' => Str::random(10),
//     ];
// });
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Daniel Pisati',
        'type' => 'admin',
        'franchise' => 'Christchurch',
        'email' => 'dpisti@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('dani1234'), // password
        'remember_token' => Str::random(10),
    ];
});
