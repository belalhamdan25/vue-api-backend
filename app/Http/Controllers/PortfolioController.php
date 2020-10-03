<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Http\Resources\Portfolio\PortfolioCollection;
use App\Tag;

class PortfolioController extends Controller
{
    public function all()
    {
        return PortfolioCollection::collection(Portfolio::paginate(18));
    }

    public function search(Request $request)
    {

        $error = ['error' => 'No results found, please try with different keywords.'];

        if ($request->has('q')) {

            $portfolios = Portfolio::search($request->get('q'))->get();
            return $portfolios->count() ? $portfolios : $error;
        }
        return $error;
    }

    public function categoriesFilter(Request $request)
    {

        $idsFromViewAsArray = $request->get('cq');
        $portfolios = Portfolio::whereIn('category', $idsFromViewAsArray)->get();
        return PortfolioCollection::collection($portfolios);
    }

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
}
