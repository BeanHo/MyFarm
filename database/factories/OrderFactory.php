<?php

use Faker\Generator as Faker;

$factory->define(\App\Order::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;

    return [
        'sn'    => str_random(10),
        'product_id'    => 1,
        'user_id'    => 1,
        'price'    => 1.23,
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
