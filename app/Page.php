<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    // Set all dates to the carbon type of dates
    public $dates = ['published_at', 'offline_at'];

    // Which items are fill-able in the database
    protected $fillable = ['author_id', 'title', 'subtitle', 'slug', 'excerpt', 'body', 'sidebar_title', 'sidebar_body', 'image', 'keywords', 'published_at', 'offline_at'];

    public $enumStatuses = [
    'dr' => 'Draft',
    'sc' => 'Scheduled',
    'pu' => 'Published',
    'of' => 'Offline',
    'er' => 'Error'
];

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
}
