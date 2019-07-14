<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExhibitionGame extends Model
{
    // Table name
    protected $table = 'exhibition_game';

    // Rows we may fill
    protected $fillable = ['developer_id', 'exhibition_id', 'game_id', 'publisher_id', 'hall', 'booth', 'genre_id'];

    // No created_at and updated_at
    public $timestamps = false;

    // Multiple games belong to one exhibitor
    public function games()
    {
        return $this->hasMany(Game::class, 'id', 'game_id');
    }
    public function exhibitions()
    {
        return $this->hasMany(Exhibition::class, 'id', 'exhibition_id');
    }
    public function developers()
    {
        return $this->hasMany(Developer::class, 'id', 'developer_id');
    }
}
