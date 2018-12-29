<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamePublisher extends Model
{
    // Table name
    protected $table = 'game_publisher';

    // Rows we may fill
    protected $fillable = ['game_id', 'publisher_id'];

    // No created_at and updated_at
    public $timestamps = false;
}
