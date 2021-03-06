<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publisher_id')->nullable()->unsigned();
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->integer('developer_id')->nullable()->unsigned();
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
            $table->integer('exhibitor_id')->nullable()->unsigned();
            $table->foreign('exhibitor_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->string('title');
            $table->string('aliases')->nullable();
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->date('released_at')->nullable();
            $table->string('line_up_year')->nullable();

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
        Schema::dropIfExists('games');
    }
}
