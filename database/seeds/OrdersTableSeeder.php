<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = factory(\App\Order::class)->times(100)->make();
        \App\Order::insert($orders->toArray());
    }
}
