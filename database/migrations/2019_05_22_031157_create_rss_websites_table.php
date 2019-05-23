<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRSSWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_websites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('url');
            $table->string('rss_url');
            $table->string('article_format');
            $table->string('date_format');
            $table->boolean('decode_utf8_title')->default(0);
            $table->boolean('date_reformat')->default(0);
            $table->boolean('active')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('rss_feeds', function (Blueprint $table) {
            $table->integer('rss_website_id')->nullable()->unsigned();
            $table->foreign('rss_website_id')->references('id')->on('rss_websites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rss_websites');

        Schema::table('rss_feeds', function (Blueprint $table) {
            $table->dropColumn('rss_website_id');
        });
    }
}
