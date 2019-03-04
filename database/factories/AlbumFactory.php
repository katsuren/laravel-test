<?php

use App\Eloquents\Album;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'artist_id' => $faker->randomNumber,
        'name' => $faker->name,
    ];
});
