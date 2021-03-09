<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class), 
        'address' => $faker->address,
        'phone'	=> $faker->randomNumber,
        'photo'	=> $faker->imageUrl(),
    ];	
});
