<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function categoriesFilterValues()
    {

        $rolesName = Category::all()->pluck('desc')->toArray();
        return $rolesName;

    }
}
