<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raids extends Model
{
    public function raid()
    {
        return $this->belongsTo('App\Raids');
    }
}
