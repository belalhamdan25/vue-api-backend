<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\MyProjectsResource;
use App\Http\Resources\User\MyPortfoliosResource;
use App\User;
use App\Transaction;

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
        $balance=User::find($id->id);

        return response()->json([
            'portfolio_count' =>$portfolioCount->portfolios->count(),
            'offers_count'=>$offers_count->projectOffers->count(),
            'projects_count'=>$offers_count->projects->count(),
            'balance_total'=>$balance->balance,

        ],200);

    }

    public function myProjects(User $id)
    {
        return new MyProjectsResource($id);
    }

    public function myPortfolios(User $id)
    {
        return new MyPortfoliosResource($id);

    }

    public function myTransaction(User $id)
    {
        $transaction = Transaction::where('user_id',$id->id)->orderBy('id', 'desc')->get();
        return $transaction;

    }

}
