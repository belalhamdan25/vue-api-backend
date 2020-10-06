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
        $portfolio = Portfolio::with('user')->paginate(18);
        return $portfolio;

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




}
