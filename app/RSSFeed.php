<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RSSFeed extends Model
{

    // Table name
    protected $table = 'rss_feeds';

    // Rows we may fill
    protected $fillable = ['site', 'title', 'url', 'categories', 'game_id', 'published_at'];

    // No created_at and updated_at
    public $timestamps = false;

    // Dates by Carbon
    public function getDates()
    {
        return ['published_at'];
    }

    public function game() {
        return $this->belongsTo(Game::class);
    }
}
