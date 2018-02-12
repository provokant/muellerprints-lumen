<?php

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

use App\User;
use App\Order;
use Illuminate\Hashing\BcryptHasher;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'activated' => true,
        'password'=> (new BcryptHasher)->make('1234567890'),
        'salutation' => $faker->title,
        'street' => $faker->streetAddress,
        'zip' => $faker->postcode,
        'town' => $faker->city,
        'country' => $faker->country,
        'phone' => $faker->e164PhoneNumber,
        'company' => $faker->company,
        'delivery_name' => $faker->firstName . ' ' . $faker->lastName,
        'delivery_street' => $faker->streetAddress,
        'delivery_zip' => $faker->postcode,
        'delivery_town' => $faker->city,
        'delivery_country' => $faker->country,
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    $sum = $faker->randomNumber(1) . ' €';
    $shippingCost = $faker->randomNumber(3) . ' €';
    
    return [
        'salutation' => $faker->title,
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'street' => $faker->streetAddress,
        'zip' => $faker->postcode,
        'town' => $faker->city,
        'country' => $faker->country,
        'email' => $faker->email,
        'company' => $faker->company,
        'phone' => $faker->e164PhoneNumber,
        'payment' => $faker->randomElement(
            ['Vorkasse', 'Nachname', 'Rechnung']
        ),
        'terms' => 1,
        'disclaimer' => 1,
        'products' => $faker->text,
        'sum' => $sum,
        'delivery' => $faker->text,
        'shippingCost' => $shippingCost,

        'user_id' => function ($faker) {
            if (array_random([true, false])) {
                return factory(App\User::class)->create()->id;
            }
            return null;
        }
    ];
});
