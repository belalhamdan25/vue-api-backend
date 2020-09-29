<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Http\Resources\Portfolio\PortfolioCollection;
use DB;

class PortfolioController extends Controller
{
    public function all(){
        return PortfolioCollection::collection(Portfolio::paginate(18));
    }

    public function search(Request $request){

 // First we define the error message we are going to show if no keywords
        // existed or if no results found.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if($request->has('q')) {

            // Using the Laravel Scout syntax to search the products table.
            $portfolios = Portfolio::search($request->get('q'))->get();

            // If there are results return them, if none, return the error message.
            return $portfolios->count() ? $portfolios : $error;

        }

        // Return the error message if no keywords existed
        return $error;
    }

    public function categoriesFilter(Request $request){

        $portfolios= DB::table('portfolios')
        ->where('category', 'like', '%'.$request->get('cq').'%')
        ->orderBy('id', 'desc')
        ->get();

        return PortfolioCollection::collection($portfolios);

    }

}
