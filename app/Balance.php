<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $attributes = [
    	'outstanding' => 0,
    	'total' => 0,
    	'withdrawable' => 0,
    	'under_review' => 0
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
