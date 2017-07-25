<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadarReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radar_report', function (Blueprint $table) {
            $table->increments('id');
            $table->text('note');
            $table->integer('speed_limit');
            $table->integer('radar_id')->unsigned()->nullable();
            $table->foreign('radar_id')->references('id')->on('radars')
              ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('radar_report');
    }
}
