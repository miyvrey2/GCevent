<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConsoleGame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('console_game', function (Blueprint $table) {
            $table->integer('console_id')->nullable()->unsigned();
            $table->foreign('console_id')->references('id')->on('consoles')->onDelete('restrict');
            $table->integer('game_id')->nullable()->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('restrict');
            $table->unique(['console_id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('console_game');
    }
}
