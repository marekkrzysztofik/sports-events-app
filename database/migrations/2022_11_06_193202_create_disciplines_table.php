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
        Schema::create('disciplines', function (Blueprint $table) { 
            $table->id('discipline_id');
            $table->string('name');
            $table->string('style');
            $table->string('competition');
            $table->string('ageGroup');
            $table->datetime('startTime');
            $table->string('sex');
            $table->integer('participants');
            $table->boolean('timeNotScore')->default(true);
            $table->boolean('bigScoreWins')->default(true);
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
        Schema::dropIfExists('disciplines');
    }
};
