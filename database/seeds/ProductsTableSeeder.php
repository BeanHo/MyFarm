<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = factory(\App\Product::class)->times(100)->make();
        \App\Product::insert($products->toArray());
    }
}
