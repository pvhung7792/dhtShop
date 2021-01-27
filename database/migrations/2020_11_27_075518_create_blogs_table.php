<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('blogs')) {
            Schema::create('blogs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('blog_cate_id');
                $table->foreign('blog_cate_id')->references('id')->on('blog_cates');
                $table->tinyInteger('status')->default(1);
                $table->string('title')->unique();
                $table->string('image')->nullable();
                $table->text('summary')->nullable();
                $table->text('content')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
