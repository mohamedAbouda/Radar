<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTowTruckAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tow_truck_accidents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tow_truck_id')->unsigned()->nullable();
            $table->foreign('tow_truck_id')->references('id')->on('tow_trucks')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('accident_id')->unsigned()->nullable();
            $table->foreign('accident_id')->references('id')->on('accedents')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->tinyInteger('state')->default(0); // 0 => on the way , 1 => done

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
        Schema::dropIfExists('tow_truck_accidents');
    }
}
