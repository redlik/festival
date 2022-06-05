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
            $table->string('name');
            $table->string('slug');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('org')->nullable();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('address1')->nullable();
            $table->string('street')->nullable();
            $table->string('town')->nullable();
            $table->string('county')->nullable();
            $table->string('eircode')->nullable();
            $table->string('website')->nullable();
            $table->string('hear_about')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->longText('events')->nullable();
            $table->string('status')->default('pending');
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
