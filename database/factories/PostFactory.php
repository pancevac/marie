<?php

use Faker\Generator as Faker;

$post = $factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => 1,
        'title' => $title,
        'slug' => str_slug($title),
        'short' => $faker->paragraph,
        'content' => $faker->paragraph,
        'image' => null,
        'image_box' => null,
        'publish_at' => $faker->dateTimeBetween('-30 days', 'now'),
        'views' => rand(100, 10000),
        'is_visible' => true,
    ];
});
