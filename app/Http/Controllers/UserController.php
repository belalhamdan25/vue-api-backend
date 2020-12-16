<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\MyProjectsResource;
use App\Http\Resources\User\MyPortfoliosResource;
use App\User;
use App\Transaction;
use App\ProjectOffer;

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
        $projectStatus=User::find($id->id);
        $offerStatus=ProjectOffer::where('user_id',$id->id)->select('status')->get();



        return response()->json([
            'portfolio_count' =>$portfolioCount->portfolios->count(),
            'offers_count'=>$offers_count->projectOffers->count(),
            'projects_count'=>$offers_count->projects->count(),
            'balance_total'=>$balance->balance,
            // 'projectStatusOpen'=>$projectStatus->projects()->select('status')->where('status','open')->get(),
            'projectStatusOpenCount'=>$projectStatus->projects()->select('status')->where('status','open')->count(),
            // 'projectStatusClosed'=>$projectStatus->projects()->select('status')->where('status','closed')->get(),
            'projectStatusClosedCount'=>$projectStatus->projects()->select('status')->where('status','closed')->count(),
            // 'projectStatusProccess'=>$projectStatus->projects()->select('status')->where('status','in proccess')->get(),
            'projectStatusProccessCount'=>$projectStatus->projects()->select('status')->where('status','in proccess')->count(),
            // 'projectStatusFinished'=>$projectStatus->projects()->select('status')->where('status','finished')->get(),
            'projectStatusFinishedCount'=>$projectStatus->projects()->select('status')->where('status','finished')->count(),
            'projectStatusCount'=>$projectStatus->projects()->select('status')->count(),
            'offerStatusAwaitingApprovalCount'=>$offerStatus->where('status','awaiting approval')->count(),
            'offerStatusInProccessCount'=>$offerStatus->where('status','in proccess')->count(),
            'offerStatusFinishedCount'=>$offerStatus->where('status','finished')->count(),
            'offerStatusCount'=>$offerStatus->count(),
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
