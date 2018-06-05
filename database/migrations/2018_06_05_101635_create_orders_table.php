<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sn')->comment('序列号');
            $table->integer('product_id')->comment('商品ID');
            $table->integer('user_id')->comment('用户ID');
            $table->double('price', 8, 2)->comment('价格');
            $table->string('express')->nullable()->comment('快递公司');
            $table->string('exp_number')->nullable()->comment('快递单号');
            $table->integer('address_id')->nullable()->comment('收货地址ID');
            $table->tinyInteger('pay_status')->default(0)->comment('支付状态 0未 1已');
            $table->tinyInteger('auc_status')->default(0)->comment('竞拍状态 1成功 2流拍');
            $table->tinyInteger('exp_status')->default(0)->comment('物流状态 2待收获 3已完成');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `myfarm_orders` comment'订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
