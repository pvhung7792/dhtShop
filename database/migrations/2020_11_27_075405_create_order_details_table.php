<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('order_details')) {
            Schema::create('order_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pro_detail_id');
                $table->foreign('pro_detail_id')->references('id')->on('product_details');
                $table->foreignId('order_id');
                $table->foreign('order_id')->references('id')->on('orders');
                $table->integer('quantity')->unsign();
                $table->float('unit_price')->unsign();
                $table->string('color');
                $table->string('name');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
