<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Resources\Projects\ProjectCollection;
use App\Http\Resources\Purchases\PurchaseCollection;
use App\Http\Resources\Projects\ProjectResource;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Tag;
use App\ProjectAttachment;
use Auth;
use App\ProjectOffer;
use App\User;
use App\Transaction;
use App\Purchase;
class ProjectController extends Controller
{
    public function all(){
        return ProjectCollection::collection(Project::orderBy('id', 'desc')->where('status','open')->orWhere('status','in proccess')->paginate(10));
    }
    public function search(Request $request)
    {
        $resultsSearch=[];
        $error = ['error' => 'No results found, please try with different keywords.'];

        if ($request->has('q')) {

            $projectId=Project::where('title', 'like', '%' . $request->get('q') . '%')->where('status','open')->orWhere('status','in proccess')->pluck('id')->toArray();

            for($i = 0; $i < count($projectId); $i++){
                $ProjectFindSearch= new ProjectCollection(Project::find($projectId[$i]));
                array_push($resultsSearch, $ProjectFindSearch);
            }

            if(count($resultsSearch) > 0){
                return $resultsSearch;
            }else{
                return $error;
            }
         }else{
            return $error;
         }

    }

    public function categoriesFilter(Request $request)
    {


        $results = [];
        $projectsId=[];

        if(gettype($request->get('cq'))=="integer"){
            $categoryId = Category::where('id', $request->get('cq'))->pluck('id')->toArray();

        }else{
            $categoryId = Category::whereIn('name', $request->get('cq'))->pluck('id')->toArray();
        }

         for($i = 0; $i < count($categoryId); $i++){
            $categoryfind = Category::find($categoryId[$i]);
            $projectResultsId= $categoryfind->projects()->where('status','open')->orWhere('status','in proccess')->pluck('id')->toArray();
            array_push($projectsId, $projectResultsId);

         }

         $projectsIdMerged = array_merge(...$projectsId);

         for($i=0;$i<count($projectsIdMerged);$i++){
           $ProjectFind= new ProjectCollection(Project::find($projectsIdMerged[$i]));
           array_push($results, $ProjectFind);

         }
        return $results;



    }

    public function skillsFilter(Request $request)
    {
        $results = [];
        $projectsId=[];
         $tagId = Tag::whereIn('name', $request->get('sq'))->pluck('id')->toArray();
         for($i = 0; $i < count($tagId); $i++){
            $tagfind = Tag::find($tagId[$i]);
            $projectResultsId= $tagfind->projects()->where('status','open')->orWhere('status','in proccess')->pluck('id')->toArray();
            array_push($projectsId, $projectResultsId);

         }

         $projectsIdMerged = array_merge(...$projectsId);

         for($i=0;$i<count($projectsIdMerged);$i++){
           $ProjectFind= new ProjectCollection(Project::find($projectsIdMerged[$i]));
           array_push($results, $ProjectFind);
         }
        return $results;

    }

    public function skillFilter(Request $request)
    {
        $results = [];

        $tagId = Tag::where('name', $request->get('skq'))->pluck('id')->first();
        $tagFind=Tag::find($tagId);
        $projectResultsId= $tagFind->projects()->where('status','open')->orWhere('status','in proccess')->pluck('id')->toArray();


        for($i=0;$i<count($projectResultsId);$i++){
            $ProjectFind= new ProjectCollection(Project::find($projectResultsId[$i]));
            array_push($results, $ProjectFind);
          }
          return $results;

    }

    public function budgetFilter(Request $request)
    {
        return ProjectCollection::collection(Project::whereBetween('budget',$request->get('bq'))->where('status','open')->orWhere('status','in proccess')->orderBy('id', 'desc')->get());
    }

    public function projectShow(Project $id){
        return new ProjectResource($id);
    }

    public function projectShowOffers(Request $request){
        $projectId=$request->get('pso');
        $projectFind=Project::find($projectId);
        $projectFindOffers = $projectFind->projectOffers()->with('user')->orderBy('id', 'asc')
        ->get();
        return $projectFindOffers;
    }
    public function projectCreate(Request $request){
        $user = Auth::user();
        $project = new Project;
        $project->user_id = $user->id;
        $project->title = $request->get('title');
        $project->desc = $request->get('desc');
        $project->budget = $request->get('budget');
        $project->time_line = $request->get('timeline');
        $project->status = "open";
        $project->category_id = $request->get('category');

        $project->save();

        $uploadedFiles=$request->pics;
        foreach($uploadedFiles as $file){
            $imageName=$file->store('projects_attachments', 's3');
             Storage::disk('s3')->setVisibility($imageName, 'public');
            $portfolio_image = new ProjectAttachment;
            $portfolio_image->project_id=$project->id;
            $portfolio_image->name=basename($imageName);
            $portfolio_image->link=Storage::disk('s3')->url($imageName);
            $portfolio_image->save();
        }

            $tagsId=$request->get('tag');
            for($i=0;$i<count($tagsId);$i++){
                $project->tags()->attach($request->tag[$i]);
            }



        return response(['status'=>'success'],200);
    }

    public function createOffer(Request $request){
        $user = Auth::user();

        $offer= New ProjectOffer;
        $offer->timeline =  request('timeline');
        $offer->coast =  request('coast');
        $offer->profit =  request('profit');
        $offer->desc =  request('desc');
        $offer->status =  "awaiting approval";
        $offer->project_id =request('project_id');
        $offer->user_id = request('user_id');
        $offer->save();


        return response()->json([
            'status' => 'success',
        ], 200);
    }

    public function projectDelete(Project $id){
        $id->delete();
        return response()->json([
            'status' => 'deleted',
        ], 200);
    }
    public function closeProject(Project $id){
        $id->status="closed";
        $id->save();
        return response()->json([
            'status' => 'closed',
        ], 200);
    }

    public function editProject(Project $id,Request $request){


        $id->title = $request->get('title');
        $id->desc = $request->get('desc');
        $id->budget = $request->get('budget');
        $id->time_line = $request->get('timeline');
        $id->category_id = $request->get('category');

        $id->update();

        if ($request->hasFile('pics')) {
            $id->projectAttachments()->delete();
            $uploadedFiles=$request->pics;
            foreach($uploadedFiles as $file){
                $imageName=$file->store('projects_attachments', 's3');
                 Storage::disk('s3')->setVisibility($imageName, 'public');
                $portfolio_image = new ProjectAttachment;
                $portfolio_image->project_id=$id->id;
                $portfolio_image->name=basename($imageName);
                $portfolio_image->link=Storage::disk('s3')->url($imageName);
                $portfolio_image->save();
            }
        }


        // if ($request->hasFile('tag')) {
            $tagsId=$request->get('tag');
            $id->tags()->detach();
            for($i=0;$i<count($tagsId);$i++){
                $id->tags()->attach($request->tag[$i]);
            }
        // }




        return response(['status'=>'success'],200);
    }

    public function acceptOffer(Request $request){
        $userBuyer=User::find($request->get('userBuyer'));
        $userVendor=User::find($request->get('userVendor'));
        $project=Project::find($request->get('project'));

        $userBuyerbalance=$userBuyer->balance;
        $coast=$request->get('coast');
        $profit=$request->get('profit');
        $ownerProfit=$coast-$profit;

        if($userBuyerbalance >= $coast){
            $userBuyer->balance=$userBuyerbalance - $coast;
            $userVendor->balance= $userVendor->balance + $profit;
            $project->status='in proccess';
            // profit for website owner $ownerProfit;
            $userBuyer->save();
            $userVendor->save();
            $project->save();

            $transaction = new Transaction;
            $transaction->desc = "Pay";
            $transaction->amount = $coast;
            $transaction->user_id = $userBuyer->id;
            $transaction->save();

            $transaction = new Transaction;
            $transaction->desc = "Transfer";
            $transaction->amount = $profit;
            $transaction->user_id = $userVendor->id;
            $transaction->save();

            Auth::user()->sent()->create([
                'body'       => "start",
                'sent_to_id' => $userVendor->id,
            ]);

            // $purchase = new Purchase;
            // $purchase->project_id=$request->get('project');
            // $purchase->user_id=$request->get('userBuyer');
            // $purchase->worker_id=$request->get('userVendor');
            // $purchase->status='in proccess';
            // $purchase->save();


            return response()->json([
                'status' => 'success',
            ]);


        }else{
            return response()->json([
                'status' => 'balance issue',
            ]);
        }

    }

    // public function allPhrchases(Request $request){

    //     $worker_idz=Purchase::where('user_id',$request->get('user_id'))->with('user')->get();

    //     return $worker_idz;






    // }

}
