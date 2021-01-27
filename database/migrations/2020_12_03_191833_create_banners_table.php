<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('banners')) {
            Schema::create('banners', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cate_id')->nullable();
                $table->foreign('cate_id')->references('id')->on('categories');
                $table->tinyInteger('status')->default(1);
                $table->string('name')->nullable();
                $table->string('home_pos')->nullable();
                $table->string('title')->nullable();
                $table->string('link')->nullable();
                $table->string('image');
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
        Schema::dropIfExists('banners');
    }
}
