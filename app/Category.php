<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //1 catogery has many  portfolio
    public function portfolios(){
        return $this->hasMany(Portfolio::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }

}
