<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    if (!Schema::hasTable('configs')) {
            Schema::create('configs', function (Blueprint $table) {
                $table->id();
                $table->string('logo');
                $table->string('phone');
                $table->string('address');
                $table->string('email');
                $table->string('bottom_footer')->nullable();
                $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('configs');
    }
}
