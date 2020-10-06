<?php

namespace App\Http\Controllers;
use App\Tag;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function skillsFilter(Request $request)
    {
        $tagid = Tag::whereIn('name', $request->get('sq'))->pluck('id')->toArray();
        $results = [];
        for ($i = 0; $i < count($tagid); $i++) {
            $tagfind = Tag::find($tagid[$i]);
            $portfolioResults = $tagfind->portfolios()->get();
            $results = array_merge($results, $portfolioResults->toArray());
        }
        return (array)$results;
    }

    public function skillsFilterNames()
    {
        // $allTagName=Tag::all();
        $allTagName = Tag::select('name')->get();

        return $allTagName;
    }
}
