<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeveloperGame extends Model
{
    // Table name
    protected $table = 'developer_game';

    // Rows we may fill
    protected $fillable = ['developer_id', 'game_id'];

    // No created_at and updated_at
    public $timestamps = false;
}
