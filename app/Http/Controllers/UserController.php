<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\User;

class UserController extends Controller
{
    public function userShow(User $id)
    {
        return new UserResource($id);

    }

    public function userDataDashboard(User $id,Request $request)
    {
        $portfolioCount=User::find($id->id);

        $offers_count=User::find($id->id);

        $categoriesName=User::find($id->id);


        return response()->json([
            'portfolio_count' =>$portfolioCount->portfolios->count(),
            'offers_count'=>$offers_count->projectOffers->count(),
            'categories_name'=>$categoriesName->category->name
        ],200);
        // if(gettype($request->get('cq'))=="integer"){
        // return "belal";
        // }else{
        //     return gettype($request->get('cq'));
        // }
    }

}
