<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsoleGame extends Model
{
    // Table name
    protected $table = 'console_game';

    // Rows we may fill
    protected $fillable = ['console_id', 'game_id'];

    // No created_at and updated_at
    public $timestamps = false;
}
