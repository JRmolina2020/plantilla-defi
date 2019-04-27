<?php

use Faker\Generator as Faker;
use App\Categorie;

$factory->define(Categorie::class, function (Faker $faker) {
    return [
         'name'=>$faker->randomElement(['miedo','accion','comedia','aventura','suspenso','infantil']),
        'state'=> $faker->numberBetween(1, 0),
    ];
});
