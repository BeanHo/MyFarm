<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIsLuckyOnGoldbeanLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goldbean_logs', function (Blueprint $table) {
            $table->integer('is_lucky')->default(1)->comment('是否幸运豆 1是 0否')->change();
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
            $table->integer('is_lucky')->comment('是否幸运豆 1是 0否')->change();
        });
    }
}
