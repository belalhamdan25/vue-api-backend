<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoriesFilter(Request $request)
    {

        $categoryId = Category::whereIn('name', $request->get('cq'))->pluck('id')->toArray();
        $results = [];
        for ($i = 0; $i < count($categoryId); $i++) {
            $tagfind = Category::find($categoryId[$i]);
            $portfolioResults = $tagfind->portfolios()->with('user')->orderBy('id', 'desc')
            ->get();
            $results = array_merge($results, $portfolioResults->toArray());
        }
        return (array)$results;

        // $idsFromViewAsArray = $request->get('cq');
        // $portfolios = Portfolio::whereIn('category', $idsFromViewAsArray)->get();
        // return PortfolioCollection::collection($portfolios);
    }

    public function categoriesFilterValues()
    {

        $categoryData=Category::all();
        return $categoryData;

    }
}
