<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->string('phone_number');
            $table->string('profile_pic');
            $table->string('cover_pic');
            $table->string('social_type');
            $table->string('social_id');
            $table->string('nationality');
            $table->string('gender');
            $table->text('biography');
            $table->decimal('balance', 10, 2)->default(0);
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->integer('delivery_time')->default(0);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('grade')->default(0);
            $table->boolean('invited')->default(false);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
