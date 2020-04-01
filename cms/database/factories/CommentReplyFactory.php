<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\CommentReply;
use App\User;
use Faker\Generator as Faker;

$factory->define(CommentReply::class, function (Faker $faker) {
    return [
        'content' => $faker->realText($faker->numberBetween(10, 50)),
        'comment_id' => Comment::all()->random()->id,
        'author_id' => User::all()->random()->id,
        'is_active' => $faker->boolean(90)
    ];
});
