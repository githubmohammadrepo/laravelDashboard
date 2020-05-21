<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'fullName' => $faker->firstName.' '.$faker->lastName,
        'about' => $faker->sentence(),
        'city' => $faker->city,
        'phone' => $faker->phoneNumber ,
        'email' => $faker->email,
        'website' => 'http://www.'.$faker->domainName,
        'publisher' => $faker->company,
        'age' => $faker->numberBetween(15,65),
        'image' =>$faker->imageUrl(100,100),
    ];
});
