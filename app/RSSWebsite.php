<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RSSWebsite extends Model
{
    // Use soft deletes
    use SoftDeletes;

    // Table name
    protected $table = 'rss_websites';

    public function RSSFeeds() {
        return $this->hasMany(RSSFeed::class);
    }
}
