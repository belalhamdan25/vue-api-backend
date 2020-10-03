<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function portfolios(){
        return $this->belongsToMany(Portfolio::class);
    }

    public function getRouteKeyName(){
        return 'name';
    }
}
