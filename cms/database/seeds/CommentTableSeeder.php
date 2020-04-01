<?php

use App\Comment;
use App\CommentReply;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(Comment::class, 3)->create()->each(function($comment) use ($faker) {
            if ($faker->boolean()) {
                $comment->replies()->save(factory(CommentReply::class)->make());
            }
        });
    }
}
