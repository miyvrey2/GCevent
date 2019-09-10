<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // Tell which table we use
    protected $table = 'games';


    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

    // Which items are fill-able in the database
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'released_at', 'publisher_id', 'developer_id', 'aliases'];

    // Multiple games belong to multiple publishers
    // Many to many (to connect pivot table in DB)
    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }

    // Multiple games belong to multiple developers
    // Many to many (to connect pivot table in DB)
    public function developers()
    {
        return $this->belongsToMany(Developer::class);
    }

    // Multiple games belong to one exhibitor at gamescom
    public function exhibitor()
    {
        return $this->belongsTo(Publisher::class, 'exhibitor_id', 'id');
    }

    // Show only published Scope in where clause

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public static function recentGames($limit = 5)
    {
        return Game::published()
                   ->orderBy('published_at', 'DESC')
                   ->limit($limit)
                   ->get();
    }

    public function scopeSearch($query, $search_query)
    {
        $searchable = ['title', 'body'];

        foreach($searchable as $column) {
            $query->orWhere($column, 'like', '%' . $search_query . '%');
        }

        return $query;
    }

    public function getReleasedAttribute()
    {
        if(!is_null($this->released_at)) {

            $date = $this->released_at;
            $separator = '-';
            $d = explode($separator, $date);

            // If month (and day as well) are unkown, show only the year
            if($d[1] == "00") {
                return Carbon::CreateFromFormat("Y-m-d", $d[0] . '-' . '01-01')->format('Y');
            } else if($d[2] == "00") {
                return Carbon::CreateFromFormat("Y-m-d", $d[0] . '-' . $d[1] . '-01')->format('F Y');
            }

            return Carbon::CreateFromFormat("Y-m-d", $this->released_at)->format('j F Y');
        }
        return 'T.B.A.';
    }

    public function getReleasedAtDayAttribute()
    {
        if(!is_null($this->released_at)) {

            return Carbon::CreateFromFormat("Y-m-d", $this->released_at)->format('j');
        }
        return '00';
    }

    public function getReleasedAtMonthAttribute()
    {
        if(!is_null($this->released_at)) {

            return Carbon::CreateFromFormat("Y-m-d", $this->released_at)->format('M');
        }
        return '00';
    }

    public function scopeLinedUp($query, $year)
    {
        return $query->where('line_up_year', $year);
    }

    public function RSSFeeds() {
        return $this->hasMany(RSSItem::class);
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    // Many to many (to connect pivot table in DB)
    public function platforms() {
        return $this->belongsToMany(Platform::class);
    }

    // Many to many (to connect pivot table in DB)
    public function genres() {
        return $this->belongsToMany(Genre::class);
    }

    // Many to many (to connect pivot table in DB)
    public function series() {
        return $this->belongsToMany(Serie::class);
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body;
    }

    public function getExcerptHtmlAttribute()
    {
        return e($this->excerpt);
    }

    public function introduction()
    {
        $genres = $this->santiziseListToString($this->genres);
        $developers = $this->santiziseListToString($this->developers);
        $publishers = $this->santiziseListToString($this->publishers);
        $series = $this->santiziseListToString($this->series);

        $string = $this->title . " is " . $this->aOrAn($genres) . " " . $genres . " game. ";
        if(!$this->developers->isEmpty() && !$this->publishers->isEmpty()) {
            if($developers === $publishers) {
                $string .= "The game is developed and published by " . $developers;
            } else {
                $string .= "The game is developed by " . $developers . " and published by " . $publishers;
            }

            if(!$this->series->isEmpty()) {
                $string .= " and is part of the " . $series . " series";
            }

            $string .= ". ";
        }
        if(!$this->developers->isEmpty() && $this->publishers->isEmpty()) {
            $string .= "The game is developed by " . $developers . ". ";
        }
        if($this->developers->isEmpty() && !$this->publishers->isEmpty()) {
            $string .= "The game is published by " . $publishers . ". ";
        }
        $string .= "The release date ";

        if($this->getReleasedAttribute() == "T.B.A.") {
            $string .= "has yet to be announced. ";
        } else {
            if (Carbon::now()->lt(Carbon::parse($this->getReleasedAttribute()))) {
                $string .= "will be " . $this->getReleasedAttribute() . ". ";
            } else {
                $string .= "was on " . $this->getReleasedAttribute() . ". ";
            }
        }

        return $string;
    }

    private function aOrAn($string)
    {
        if($string == "") {
            return "a";
        }

        $klinker = ['a', 'e', 'i', 'o', 'u'];

        if(in_array($string[0], $klinker)) {
            return "an";
        } else {
            return "a";
        }
    }

    public function santiziseListToString($array)
    {
        // If the array is empty, return
        if($array->isEmpty()){
            return "";
        }

        $string = "";

        foreach($array as $key => $value) {
            $string .= $value->title;

            if (count($array) > 1) {
                if ($key <= count($array) - 3) {
                    $string .= ', ';
                }

                if ($key == count($array) - 2) {
                    $string .= ' and ';
                }
            }
        }

        return $string;
    }
}
