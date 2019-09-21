<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raids extends Model
{
    protected $softCascade = ['bosses'];

    public function bosses()
    {
        return $this->hasMany('App\Boss');
    }
}
