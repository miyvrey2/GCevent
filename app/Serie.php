<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    // Which items are fill-able in the database
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'keywords'];

    // Select which columns from the database contain dates (and can be used by Carbon)
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDateAttribute()
    {
        return is_null($this->updated_at) ? '' : $this->updated_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body;
    }

    public function getExcerptHtmlAttribute()
    {
        return e($this->excerpt);
    }

    // A serie has many games
    // Many to many (to connect pivot table in DB)
    public function games() {
        return $this->belongsToMany(Game::class);
    }
}
