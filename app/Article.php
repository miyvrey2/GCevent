<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{

    use SoftDeletes;

    // Set all dates to the carbon type of dates
    public $dates = ['created_at', 'updated_at', 'published_at', 'offline_at', 'deleted_at'];

    // Which items are fill-able in the database
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'offline_at' , 'game_id', 'author_id', 'keywords', 'source', 'image'];

    public $enumStatuses = [
        'dr' => 'Draft',
        'sc' => 'Scheduled',
        'pu' => 'Published',
        'of' => 'Offline',
        'er' => 'Error'
    ];

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

    public function getStatusAttribute()
    {
        // If the offline date has not been set, make a fake one for in the future so we can loop
        $this->offline_at = ($this->offline_at === null) ? Carbon::tomorrow() : $this->offline_at;

        if ($this->published_at == null) {
            $status = $this->enumStatuses['dr'];
        } else if ($this->published_at > Carbon::now()) {
            $status = $this->enumStatuses['sc'];
        } else if ($this->published_at < Carbon::now() && $this->offline_at > Carbon::now()) {
            $status = $this->enumStatuses['pu'];
        } else if ($this->offline_at < Carbon::now()) {
            $status = $this->enumStatuses['of'];
        } else {
            $status = $this->enumStatuses['er'];
        }

        return $status;
    }

    // Show only published Scope in where clause
    public function scopePublished($query)
    {
        return $query->where([
            ['published_at', '<=', Carbon::now()],
            ['offline_at', '>=', Carbon::now()]
        ])->orWhere([
            ['published_at', '<=', Carbon::now()],
            ['offline_at', '=', null]
        ]);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public static function recentArticles($limit = 5)
    {
        return Article::published()->orderBy('published_at', 'DESC')->limit($limit)->get();
    }
}
