<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTowTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tow_trucks', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->default('')->nullable();
            $table->string('phone')->default('')->nullable();
            $table->string('pic')->default('')->nullable();
            $table->string('model')->default('')->nullable();
            $table->string('plate_number')->default('')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tow_trucks');
    }
}
