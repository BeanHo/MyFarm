<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('用户ID');
            $table->string('username')->comment('收货人姓名');
            $table->string('postal_code')->comment('邮编');
            $table->string('province_name')->comment('国标收货地址第一级地址');
            $table->string('city_name')->comment('国标收货地址第二级地址');
            $table->string('county_name')->comment('国标收货地址第三级地址');
            $table->string('detail_info')->comment('详细收货地址');
            $table->string('tel_number')->comment('收货人手机号码');
            $table->string('isdefault')->comment('是否默认地址 0否 1是');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `myfarm_addresses` comment'收货地址表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
