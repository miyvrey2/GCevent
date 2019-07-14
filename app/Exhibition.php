<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exhibition extends Model
{
    // Which items are fill-able in the database
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'latitude', 'longitude', 'starts_at', 'ends_at', 'aliases', 'image'];

    // Select which columns from the database contain dates (and can be used by Carbon)
    public function getDates()
    {
        return ['created_at', 'updated_at', 'starts_at', 'ends_at'];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body;
    }

    // Show only upcoming Scope in where clause
    public function scopeUpcoming($query)
    {
        return $query->where('starts_at', '>=', Carbon::now());
    }

    // Multiple games belong to one exhibitor at gamescom
    public function booths()
    {
        return $this->hasMany(ExhibitionGame::class);
    }

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class, 'exhibition_game',
            'exhibition_id', 'publisher_id')
                    ->groupBy('exhibition_game.publisher_id');
    }
}
