<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusOnGoldbeanLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goldbean_logs', function (Blueprint $table) {
            $table->integer('status')->default(0)->comment('可采集状态 1是 0否')->change();
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
            $table->integer('status')->comment('可采集状态 1是 0否')->change();
        });
    }
}
