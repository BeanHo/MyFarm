<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('名称');
            $table->string('img_url')->comment('图片');
            $table->string('intro')->comment('商品简介');
            $table->string('prompt')->comment('温馨提示');
            $table->string('service_tel_number')->nullable()->comment('客服电话');
            $table->double('bid_price', 8, 2)->nullable()->comment('竞价');
            $table->double('price', 8, 2)->comment('价格');
            $table->tinyInteger('stock')->comment('库存');
            $table->tinyInteger('type')->comment('类型 1一口价 2竞拍 3特殊');
            $table->timestamp('start_at')->nullable()->comment('开始时间');
            $table->timestamp('end_at')->nullable()->comment('结束时间');
            $table->tinyInteger('shelf_status')->default(0)->comment('上架状态 1是 0否');
            $table->tinyInteger('auc_status')->default(0)->comment('竞拍状态 1成功 2流拍');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `myfarm_products` comment'商品表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
