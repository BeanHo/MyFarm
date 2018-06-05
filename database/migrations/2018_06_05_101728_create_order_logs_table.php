<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->comment('订单ID');
            $table->integer('username')->comment('竞拍状态 1成功 2流拍');
            $table->integer('postal_code')->comment('物流状态 2待收获 3已完成');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `myfarm_order_logs` comment'订单明细表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_logs');
    }
}
