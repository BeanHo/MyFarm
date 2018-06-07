<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('potato_num')->default(0)->comment('土豆数');
            $table->integer('gold_num')->default(0)->comment('金豆数');
            $table->string('truename')->nullable()->comment('真实姓名');
            $table->string('ID_number')->nullable()->comment('身份证号');
            $table->string('Invitation_code')->nullable()->comment('邀请码');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `myfarm_user_datas` comment'用户资料表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_datas');
    }
}
