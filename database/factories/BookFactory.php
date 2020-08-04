<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $hoy = date("Y-m-d"); 
    return [
        'publish_date' => $faker->date('Y-m-d', $hoy),
        'title'=>$faker->title,
        'author_id' => factory(App\Author::class),
    ];
});
