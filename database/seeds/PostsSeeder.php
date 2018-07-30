<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Post::class, 100)->create()->each(function($post) {
            $post->tag()->attach(rand(1,5));
            $post->blog()->attach(rand(1,5));
        });
    }
}
