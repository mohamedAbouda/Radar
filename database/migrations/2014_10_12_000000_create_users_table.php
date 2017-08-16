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
            $table->string('full_name');
            $table->string('profile_pic');
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('password');
            $table->string('social_type');
            $table->string('social_id');
            $table->integer('account_type');
            $table->integer('is_on_duty');
            $table->string('confirmation');
            $table->string('confirmation_code');
            $table->integer('confirmed')->default(0);
            $table->integer('activated');
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
