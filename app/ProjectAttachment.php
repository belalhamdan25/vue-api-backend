<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectAttachment extends Model
{
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
