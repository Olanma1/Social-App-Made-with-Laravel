<?php

namespace Database\Factories;

use App\Post;
use App\Models\User;
use Faker\Generator as Faker;
//use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */



    $factory->define(Post::class, function (Faker $faker)
    {
        return [
'user_id'=>User::factory(),
'body'=>$faker->sentence,
'image'=>'image.jpg',
        ];
    });

