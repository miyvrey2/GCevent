<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterConsolesTableToPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename consoles to platforms-table
        Schema::rename('consoles', 'platforms');
        Schema::rename('console_game', 'game_platform');

        Schema::table('game_platform', function (Blueprint $table) {
            $table->renameColumn('console_id', 'platform_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rename back to consoles
        Schema::rename('platforms', 'consoles');
        Schema::rename('game_platform', 'console_game');

        Schema::table('console_game', function (Blueprint $table) {
            $table->renameColumn('platform_id', 'console_id');
        });
    }
}
