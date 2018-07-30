<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    public function getDates()
    {
        return ['created_at', 'updated_at', 'found'];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDateAttribute()
    {
        return is_null($this->updated_at) ? '' : $this->updated_at->diffForHumans();
    }

    public function getFoundedAttribute()
    {
        return Carbon::parse($this->found)->toFormattedDateString();
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body;
    }

    public function getExcerptHtmlAttribute()
    {
        return e($this->excerpt);
    }

    // A publisher has many games
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    // A publisher has many stands
    public function stands()
    {
        return $this->hasMany(Stand::class);
    }
}
