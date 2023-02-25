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
            $table->id();
            $table->string('name');
            $table->string('style');
            $table->string('competition');
            $table->string('ageGroup');
            $table->datetime('startTime');
            $table->string('sex');
            $table->integer('participants');
            $table->integer('timeNotScore')->default(1);
            $table->integer('bigScoreWins')->default(1);
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
