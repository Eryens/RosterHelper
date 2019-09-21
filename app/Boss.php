<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boss extends Model
{
    public function raid()
    {
        return $this->belongsTo('App\Raid');
    }
}
