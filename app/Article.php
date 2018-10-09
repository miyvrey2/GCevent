<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{

    use SoftDeletes;

    // Set all dates to the carbon type of dates
    public $dates = ['created_at', 'updated_at', 'published_at', 'deleted_at'];

    // Rows we may fill
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'game_id', 'author_id', 'keywords'];

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

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public static function recentArticles()
    {
        return Article::published()->orderBy('published_at', 'DESC')->limit(5)->get();
    }
}
