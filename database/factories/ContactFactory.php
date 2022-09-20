<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(\App\Models\Contact::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->safeEmail(),
        'phone' => $faker->phoneNumber(),
        'birthdate' => $faker->date(),
        'photo' => $faker->imageUrl(),
    ];
});
