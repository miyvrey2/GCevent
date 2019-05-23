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

    // Rows we may fill
    protected $fillable = ['title', 'url', 'rss_url', 'article_format', 'date_format', 'decode_utf8_title', 'date_reformat', 'active'];

    public function RSSFeeds() {
        return $this->hasMany(RSSFeed::class, 'rss_website_id');
    }
}
