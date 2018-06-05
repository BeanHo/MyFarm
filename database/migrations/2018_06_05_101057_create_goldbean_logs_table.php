<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoldbeanLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goldbean_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('from_id')->comment('关联ID：赠送来源');
            $table->integer('order_id')->comment('订单ID');
            $table->tinyInteger('type')->comment('类型ID 0发放/采集 1注册 2红包 3获赠 4赠出 5购买 6独家任务');
            $table->double('num', 20, 5)->comment('金豆值');
            $table->tinyInteger('is_lucky')->comment('是否幸运豆 1是 0否');
            $table->tinyInteger('status')->comment('可采集状态 1是 0否');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `myfarm_goldbean_logs` comment'金豆明细表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goldbean_logs');
    }
}
