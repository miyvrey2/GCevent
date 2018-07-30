<?php

namespace App;

use App\Publisher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    public function getDates()
    {
        return ['created_at', 'updated_at', 'published_at'];
    }

    // Rows we may fill
    protected $fillable = ['publisher_id', 'title', 'slug'];


    // Multiple games belong to one publisher
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function scopeLinedUp($query, $year)
    {
        return $query->where('line_up_year', $year);
    }

    public function RSSFeeds() {
        return $this->hasMany(RSSFeed::class);
    }
}
