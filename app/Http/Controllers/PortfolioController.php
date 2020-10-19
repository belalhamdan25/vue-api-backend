<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\PortfolioImage;
use App\Http\Resources\Portfolio\PortfolioCollection;
use App\Http\Resources\Portfolio\PortfolioResource;
use App\Tag;
use App\Category;
class PortfolioController extends Controller
{
    public function all()
    {
        $portfolio = Portfolio::with('user','portfolioImages')->orderBy('id', 'desc')->paginate(18);
        return $portfolio;

    }

    public function portfolioShow(Portfolio $id)
    {
        return new PortfolioResource($id);

    }

    public function portfolioShowSkills(Portfolio $id)
    {
        return $id->tags;

    }

    public function search(Request $request)
    {

        $error = ['error' => 'No results found, please try with different keywords.'];

        if ($request->has('q')) {

        $Portfolio = Portfolio::where('title', 'like', '%' . $request->get('q') . '%')->orWhere('desc', 'like', '%' . $request->get('q') . '%')
        ->with('user','portfolioImages')->get();

        if($Portfolio->count() > 0){
            return $Portfolio;
        }else{
            return $error;
        }

         }else{
            return $error;

         }
    }

    public function portfolioShowImages(Request $request){
        $portfolioId=$request->get('pm');
        $images=Portfolio::find($portfolioId);
        return $images->portfolioImages;

    }

    public function categoriesFilter(Request $request)
    {

        $categoryId = Category::whereIn('name', $request->get('cq'))->pluck('id')->toArray();
        $results = [];
        for ($i = 0; $i < count($categoryId); $i++) {
            $tagfind = Category::find($categoryId[$i]);
            $portfolioResults = $tagfind->portfolios()->with('user','portfolioImages')->orderBy('id', 'desc')
            ->get();
            $results = array_merge($results, $portfolioResults->toArray());
        }
        return (array)$results;

        // $idsFromViewAsArray = $request->get('cq');
        // $portfolios = Portfolio::whereIn('category', $idsFromViewAsArray)->get();
        // return PortfolioCollection::collection($portfolios);
    }

    public function skillsFilter(Request $request)
    {
        $tagid = Tag::whereIn('name', $request->get('sq'))->pluck('id')->toArray();
        $results = [];
        for ($i = 0; $i < count($tagid); $i++) {
            $tagfind = Tag::find($tagid[$i]);
            $portfolioResults = $tagfind->portfolios()->with('user','portfolioImages')->orderBy('id', 'desc')->get();
            $results = array_merge($results, $portfolioResults->toArray());
        }
        return (array)$results;
    }

    public function skillFilter(Request $request)
    {
        $tagid = Tag::where('name', $request->get('skq'))->pluck('id')->first();
        $tagFind=Tag::find($tagid);
        return $tagFind->portfolios()->with('user','portfolioImages')->orderBy('id', 'desc')->get();
    }


}
