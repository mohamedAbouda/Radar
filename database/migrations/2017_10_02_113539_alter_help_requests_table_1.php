<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHelpRequestsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_requests', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->nullable()->after('driver_id');
            $table->foreign('group_id')->references('id')->on('groups')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('help_requests', function (Blueprint $table) {
            // $table->dropIndex('help_requests_group_id_foreign');
            // $table->dropColumn('group_id');
        // });
    }
}
