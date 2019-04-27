<?php

use Faker\Generator as Faker;
use App\Movie;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'sipnosis'=>$faker->sentence(8),
        'iframe'=>"https://www.youtube.com/embed/Bcz-XR3HTMk",
        'launching'=>"2019-04-02",
        'state'=>rand(0,1),
        'file'=>$faker->imageUrl($width=563,$height=692),
        'category_id'=>rand(1,20),
    ];
});
