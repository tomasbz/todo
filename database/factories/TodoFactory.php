<?php

use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
        'body' => $faker->text(100),
    ];
});
