<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameGenre extends Model
{
    // Table name
    protected $table = 'game_genre';

    // Rows we may fill
    protected $fillable = ['game_id', 'genre_id'];

    // No created_at and updated_at
    public $timestamps = false;
}
