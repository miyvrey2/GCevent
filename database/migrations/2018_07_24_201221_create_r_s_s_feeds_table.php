<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRSSFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site');
            $table->string('title');
            $table->string('url');
            $table->text('categories')->nullable();
            $table->integer('game_id')->nullable()->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('restrict');
            $table->datetime('published_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rss_feeds');
    }
}
