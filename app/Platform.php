<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'image', 'aliases', 'released_at'];

    //
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

    // Many to many (to connect pivot table in DB)
    public function games() {
        return $this->belongsToMany(Game::class)->orderBy("title");
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body;
    }

    public function getExcerptHtmlAttribute()
    {
        return e($this->excerpt);
    }
}
