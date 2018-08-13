<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    public function getDates()
    {
        return ['created_at', 'updated_at', 'released_at'];
    }

    // Rows we may fill
    protected $fillable = ['publisher_id', 'title', 'slug'];


    // Multiple games belong to one publisher
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    // Multiple games belong to one publisher
    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    // Multiple games belong to one exhibitor at gamescom
    public function exhibitor()
    {
        return $this->belongsTo(Publisher::class, 'exhibitor_id', 'id');
    }

    // results in a "problem", se examples below
    public function available_publisher() {
        return $this->publisher()->where('id','>', 1);
    }

    public function getReleasedAttribute()
    {
        if(!is_null($this->released_at)) {
            return $this->released_at->format('j F Y');
        }
        return '';
    }

    public function scopeLinedUp($query, $year)
    {
        return $query->where('line_up_year', $year);
    }

    public function RSSFeeds() {
        return $this->hasMany(RSSFeed::class);
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    // Many to many (to connect pivot table in DB)
    public function consoles() {
        return $this->belongsToMany(Console::class);
    }
}
