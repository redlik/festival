<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('end_date');
            $table->string('leader_email')->after('venue_id')->nullable();
            $table->string('leader_phone')->after('venue_id')->nullable();
            $table->string('leader_name')->after('venue_id')->nullable();
            $table->string('status')->default('published')->after('venue_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
