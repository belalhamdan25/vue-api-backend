<?php

namespace App\Http\Controllers;
use App\Tag;

use Illuminate\Http\Request;

class TagController extends Controller
{


    public function skillsFilterNames()
    {
        // $allTagName=Tag::all();
        $allTagName = Tag::select('name')->get();

        return $allTagName;
    }
}
