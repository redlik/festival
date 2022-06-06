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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->longText('description');
            $table->string('type');
            $table->string('covid')->default('no');
            $table->json('target')->nullable();
            $table->json('categories')->nullable();
            $table->boolean('limited')->default(false);
            $table->integer('attendees')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('venue_id')->nullable();
            $table->timestamps();

            $table->foreign('venue_id')->references('id')->on('venues')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
