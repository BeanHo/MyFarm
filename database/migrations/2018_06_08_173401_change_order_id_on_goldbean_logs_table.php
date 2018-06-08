<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrderIdOnGoldbeanLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goldbean_logs', function (Blueprint $table) {
            $table->integer('order_id')->nullable()->comment('订单ID')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goldbean_logs', function (Blueprint $table) {
            $table->integer('order_id')->comment('订单ID')->change();
        });
    }
}
