<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Http\Resources\Portfolio\PortfolioCollection;

class PortfolioController extends Controller
{
    public function all(){
        return PortfolioCollection::collection(Portfolio::paginate(20));
    }
}
