<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raids extends Model
{
    public function bosses()
    {
        return $this->hasMany('App\Boss');
    }
}
