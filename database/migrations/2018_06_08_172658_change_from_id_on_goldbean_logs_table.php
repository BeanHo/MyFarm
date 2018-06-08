<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFromIdOnGoldbeanLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goldbean_logs', function (Blueprint $table) {
            $table->integer('from_id')->nullable()->comment('关联ID：赠送来源')->change();
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
            $table->integer('from_id')->comment('关联ID：赠送来源')->change();
        });
    }
}
