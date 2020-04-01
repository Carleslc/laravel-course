<?php

use App\Post;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $author = Role::firstOrCreate(['name' => 'author']);
        $subscriber = Role::firstOrCreate(['name' => 'subscriber']);
        // Admin
        $email = 'admin@example.com';
        $password = Str::random(8);
        echo "$email -> $password" . PHP_EOL;
        User::updateOrCreate(['name' => 'Admin'], [
            'name' => 'Admin',
            'email' => $email,
            'password' => bcrypt($password),
            'role_id' => $admin->id
        ]);
        // Authors & Subscribers
        $faker = Faker\Factory::create();
        factory(User::class, 3)->create()->each(function($user) use ($faker, $author, $subscriber) {
            $is_author = $faker->boolean($chanceOfGettingTrue = 75);
            if ($is_author) {
                $user->posts()->save(factory(Post::class)->make());
            }
            $user->role()->associate($is_author ? $author : $subscriber);
            $user->save();
        });
    }
}
