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

        $Portfolio = Portfolio::where([
            ['title', 'LIKE', '%' .  $request->get('q') . '%'],
            ['desc', 'LIKE', '%' .  $request->get('q') . '%'],
        ])
        ->with('user','portfolioImages')->get();
        return $Portfolio->count() ? $Portfolio : $error;
         }
         return $error;


        // $error = ['error' => 'No results found, please try with different keywords.'];

        // if ($request->has('q')) {

        //     $portfolios = Portfolio::search($request->get('q'))->get();
        //     return $portfolios->count() ? $portfolios : $error;
        // }
        // return $error;
        // php artisan scout:import "App\Portfolio"


    }

    public function portfolioShowImages(Request $request){
        $portfolioId=$request->get('pm');
        $images=Portfolio::find($portfolioId);
        return $images->portfolioImages;

    }





}
