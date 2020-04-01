<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($faker->numberBetween(10,20)),
        'content' => $faker->paragraphs($faker->numberBetween(1,10), true),
        'category_id' => Category::all()->random()->id
    ];
});
