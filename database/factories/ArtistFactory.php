<?php

use App\Eloquents\Artist;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Artist::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
