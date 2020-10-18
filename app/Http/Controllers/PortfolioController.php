<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\PortfolioImage;
use App\Http\Resources\Portfolio\PortfolioCollection;
use App\Http\Resources\Portfolio\PortfolioResource;
use App\Tag;

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





}
