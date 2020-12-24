<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function projectOffers(){
        return $this->hasMany(ProjectOffer::class);
    }

    public function projectAttachments(){
        return $this->hasMany(ProjectAttachment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function purchase(){
        return $this->belongsToMany(Purchase::class);
    }


}
