<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\PortfolioImage;
use App\Http\Resources\Portfolio\PortfolioCollection;
use App\Http\Resources\Portfolio\PortfolioResource;
use App\Tag;
use App\Category;
use Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function all()
    {
        $portfolio = Portfolio::with('user', 'portfolioImages')->orderBy('id', 'desc')->paginate(18);
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
                ->with('user', 'portfolioImages')->get();

            if ($Portfolio->count() > 0) {
                return $Portfolio;
            } else {
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function portfolioShowImages(Request $request)
    {
        $portfolioId = $request->get('pm');
        $images = Portfolio::find($portfolioId);
        return $images->portfolioImages;
    }

    public function categoriesFilter(Request $request)
    {

        $categoryId = Category::whereIn('name', $request->get('cq'))->pluck('id')->toArray();
        $results = [];
        for ($i = 0; $i < count($categoryId); $i++) {
            $tagfind = Category::find($categoryId[$i]);
            $portfolioResults = $tagfind->portfolios()->with('user', 'portfolioImages')->orderBy('id', 'desc')
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
            $portfolioResults = $tagfind->portfolios()->with('user', 'portfolioImages')->orderBy('id', 'desc')->get();
            $results = array_merge($results, $portfolioResults->toArray());
        }
        return (array)$results;
    }

    public function skillFilter(Request $request)
    {
        $tagid = Tag::where('name', $request->get('skq'))->pluck('id')->first();
        $tagFind = Tag::find($tagid);
        return $tagFind->portfolios()->with('user', 'portfolioImages')->orderBy('id', 'desc')->get();
    }

    public function portfoliosCreate(Request $request)
    {
        $user = Auth::user();

        $portfolio = new Portfolio;
        $portfolio->user_id = $user->id;
        $portfolio->title = $request->get('title');
        $portfolio->desc = $request->get('desc');
        $portfolio->link = $request->get('link');
        $portfolio->date = $request->get('date');
        $portfolio->category_id = $request->get('category_id');
        $portfolio->save();

        $userTag = Portfolio::find($portfolio->id);
        $userTag->tags()->sync(request('tags_id[]'));
        $userTag->save();

        // $images_urls = [];
        // for ($i = 0; $i < count($request->portfolioImages_name); $i++) {
        //     $portfolioImage_name = new PortfolioImage;
        //     $imageName = $request->portfolioImages_name[$i]->store('portfolio_images', 's3');
        //     $portfolioImage_name->portfolio_id = $portfolio->id;
        //     $portfolioImage_name->name = Storage::disk('s3')->url($imageName);
        //     $portfolioImage_url = Storage::disk('s3')->url($imageName);
        //     Storage::disk('s3')->setVisibility($imageName, 'public');
        //     $portfolioImage_name->save();
        //     array_push($images_urls, $portfolioImage_url);
        // }

        $uploadedFiles=$request->pics;
        foreach($uploadedFiles as $file){
           $portfolioImage = new PortfolioImage;
           $imageName = $file->store('portfolio_images', 's3');
            $portfolioImage->portfolio_id = $portfolio->id;
            $portfolioImage->name = Storage::disk('s3')->url($imageName);
            Storage::disk('s3')->setVisibility($imageName, 'public');
            $portfolioImage->save();
        }

        return response()->json([
            'status' => "success",
        ]);
    }
}
