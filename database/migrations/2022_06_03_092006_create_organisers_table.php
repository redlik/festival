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
        Schema::create('organisers', function (Blueprint $table) {
            $table->id();
            $table->string('org')->nullable();
            $table->string('phone');
            $table->string('address1');
            $table->string('street');
            $table->string('town');
            $table->string('county');
            $table->string('eircode');
            $table->string('website')->nullable();
            $table->string('hear_about')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->longText('events')->nullable();
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
        Schema::dropIfExists('organisers');
    }
};
