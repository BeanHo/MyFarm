<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePotatoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potato_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->comment('类型：注册/登录/邀请好友...');
            $table->tinyInteger('num')->comment('获得土豆值');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `myfarm_potato_settings` comment'土豆设置表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('potato_settings');
    }
}
