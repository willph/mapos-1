<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'document_number' => $faker->word,
        'phone_number' => $faker->phoneNumber,
        'mobile_phone_number' => $faker->word,
        'email' => $faker->safeEmail,
        'postal_code' => $faker->postcode,
        'street_number' => $faker->numberBetween(0, 1000),
        'street_name' => $faker->streetAddress,
        'neighborhood' => $faker->word,
        'city' => $faker->city,
        'state' => $faker->state,
    ];
});
