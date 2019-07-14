<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibition_game', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('developer_id')->nullable()->unsigned();
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
            $table->integer('exhibition_id')->nullable()->unsigned();
            $table->foreign('exhibition_id')->references('id')->on('exhibitions')->onDelete('cascade');
            $table->integer('game_id')->nullable()->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->integer('publisher_id')->nullable()->unsigned();
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->string('hall')->nullable();
            $table->string('booth')->nullable();
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
        Schema::dropIfExists('exhibition_game');
    }
}
