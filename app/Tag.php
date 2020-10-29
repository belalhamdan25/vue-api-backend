<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function portfolios(){
        return $this->belongsToMany(Portfolio::class);
    }

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function getRouteKeyName(){
        return 'name';
    }
}
