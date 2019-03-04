<?php

use App\Eloquents\Song;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'album_id' => $faker->randomNumber,
        'name' => $faker->name,
    ];
});
