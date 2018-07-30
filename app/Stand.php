<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    // Multiple stands belong to one publisher
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
