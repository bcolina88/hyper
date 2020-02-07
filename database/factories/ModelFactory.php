<?php

use Faker\Generator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->firstNameMale,
        'dni'   => $faker->randomNumber($nbDigits = 8, $strict = false),
        'username' => $faker->username,
        'lastName' => $faker->lastName,
        'fullName' => $faker->firstNameMale.' '.$faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'birthDate' => $faker->date,
        'phone'       => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'created_at' => $date = $faker->dateTimeThisMonth,
        'updated_at' => $date
    ];
});

