<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLagnaReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lagna_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fine')->default(0);
            $table->text('fine_cause');
            $table->text('note');
            $table->integer('lagna_id')->unsigned()->nullable();
            $table->foreign('lagna_id')->references('id')->on('lagnas')
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
        Schema::dropIfExists('lagna_report');
    }
}
