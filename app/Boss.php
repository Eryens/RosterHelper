<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boss extends Model
{
    public function bosses()
    {
        return $this->hasMany('App\Boss');
    }
}
