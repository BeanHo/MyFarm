<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;

    return [
        'name'    => str_random(10),
        'img_url'    => 'http://o8uz2td92.bkt.clouddn.com/2017-02-09_589c0fa247401.jpg',
        'intro'    => str_random(10),
        'prompt'    => str_random(10),
        'service_tel_number'    => '12345678',
        'bid_price'    => '1.00',
        'price'    => '1.00',
        'stock'    => 3,
        'type'    => 3,
        'start_at'    => $date_time,
        'end_at'    => $date_time,
        'shelf_status'    => 1,
        'auc_status'    => 0,
    ];
});
