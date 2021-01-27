<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->foreignId('brand_id');
                $table->foreign('brand_id')->references('id')->on('brands');
                $table->foreignId('promotion_id');
                $table->foreign('promotion_id')->references('id')->on('promotions');
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->string('image');
                $table->tinyInteger('status')->default(1);
                $table->string('origin')->nullable();
                $table->string('year')->nullable();
                $table->string('battery')->nullable();
                $table->string('sim')->nullable();
                $table->string('screen_size')->nullable();
                $table->string('in_box')->nullable();
                $table->string('gpu')->nullable();
                $table->string('os')->nullable();
                $table->string('weight')->nullable();
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
        Schema::dropIfExists('products');
    }
}
