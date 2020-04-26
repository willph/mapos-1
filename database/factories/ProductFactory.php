<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'barcode' => $faker->word,
        'purchase_price' => $faker->randomFloat(2, 0, 99999999.99),
        'sale_price' => $faker->randomFloat(2, 0, 99999999.99),
        'unit' => $faker->word,
        'quantity_in_stock' => $faker->randomNumber(),
        'minimum_quantity_in_stock' => $faker->randomNumber(),
    ];
});
