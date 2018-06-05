<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePotatoLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potato_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('用户ID');
            $table->tinyInteger('setting_id')->comment('类型ID');
            $table->tinyInteger('num')->comment('获得土豆值');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `myfarm_potato_logs` comment'土豆明细表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('potato_logs');
    }
}
