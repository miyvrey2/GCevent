<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // Which items are fill-able in the database
    protected $fillable = ['author_id', 'title', 'subtitle', 'slug', 'excerpt', 'body', 'sidebar_title', 'sidebar_body', 'image', 'published_at'];

    // Add published_at to the "date" type
    public $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Multiple pages belong to 1 user
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateAttribute()
    {
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body;
    }

    public function getExcerptHtmlAttribute()
    {
        return e($this->excerpt);
    }

    // Show only published Scope in where clause
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }
}
