<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    // Which items are fill-able in the database
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'image', 'url', 'found'];

    // Select which columns from the database contain dates (and can be used by Carbon)
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDateAttribute()
    {
        return is_null($this->updated_at) ? '' : $this->updated_at->diffForHumans();
    }

    public function getFoundYmdAttribute()
    {
        return is_null($this->found) ? '' : str_replace(' 00:00:00', '', $this->found);
    }

    public function getFoundedAttribute()
    {
        if(!is_null($this->found)) {

            $date = $this->found;
            $separator = '-';
            $d = explode($separator, $date);
            $d[2] = explode(' ', $d[2])[0];

            // If month (and day as well) are unkown, show only the year
            if($d[1] == "00") {
                return Carbon::CreateFromFormat("Y-m-d", $d[0] . '-' . '01-01')->format('Y');
            } else if($d[2] == "00") {
                return Carbon::CreateFromFormat("Y-m-d", $d[0] . '-' . $d[1] . '-01')->format('F Y');
            }

            $dateText = Carbon::parse($this->found)->format('l jS \\of F Y');
            return "<a href='#' title='" . $dateText . "'>$d[0]</a>";
        }
        return 'Unkown.';
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body;
    }

    public function getExcerptHtmlAttribute()
    {
        return e($this->excerpt);
    }

    // A developer has many games
    // Many to many (to connect pivot table in DB)
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function exhibitor_games()
    {
        return $this->hasMany(Game::class, 'exhibitor_id', 'id');
    }

    public function exhibitionGame()
    {
        return $this->hasMany(ExhibitionGame::class, 'developer_id', 'id');
    }

    public function exhibition_booths()
    {
        return $this->hasMany(ExhibitionGame::class, 'developer_id', 'id');
    }

    public function exhibition_games()
    {
        return $this->belongsToMany(Game::class, 'exhibition_game',
            'developer_id', 'game_id');
    }

    public function exhibition_game()
    {
        return $this->belongsToMany(Game::class, 'exhibition_game',
            'developer_id', 'game_id');
    }

    public function games_for_gamescom_2019()
    {
        return $this->belongsToMany(Game::class, 'exhibition_game',
            'developer_id', 'game_id')->where('exhibition_game.exhibition_id', '=', 1);
    }
}
