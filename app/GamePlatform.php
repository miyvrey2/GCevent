<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamePlatform extends Model
{
    // Table name
    protected $table = 'game_platform';

    // Rows we may fill
    protected $fillable = ['platform_id', 'game_id'];

    // No created_at and updated_at
    public $timestamps = false;
}
