<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product_details')) {
            Schema::create('product_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id');
                $table->foreign('product_id')->references('id')->on('products');
                $table->tinyInteger('status')->default(1);
                $table->float('price')->unsign();
                $table->float('sale_price')->unsign()->nullable();
                $table->string('memory')->nullable();
                $table->string('ram')->nullable();
                $table->string('cpu')->nullable();
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
        Schema::dropIfExists('product_details');
    }
}
