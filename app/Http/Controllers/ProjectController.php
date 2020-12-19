<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Resources\Projects\ProjectCollection;
use App\Http\Resources\Projects\ProjectResource;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Tag;
use App\ProjectAttachment;
use Auth;
class ProjectController extends Controller
{
    public function all(){

        return ProjectCollection::collection(Project::orderBy('id', 'desc')->paginate(18));

    }

    public function search(Request $request)
    {
        $resultsSearch=[];
        $error = ['error' => 'No results found, please try with different keywords.'];

        if ($request->has('q')) {

            $projectId=Project::where('title', 'like', '%' . $request->get('q') . '%')->pluck('id')->toArray();

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
            $projectResultsId= $categoryfind->projects()->pluck('id')->toArray();
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
            $projectResultsId= $tagfind->projects()->pluck('id')->toArray();
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
        $projectResultsId= $tagFind->projects()->pluck('id')->toArray();


        for($i=0;$i<count($projectResultsId);$i++){
            $ProjectFind= new ProjectCollection(Project::find($projectResultsId[$i]));
            array_push($results, $ProjectFind);
          }
          return $results;

    }

    public function budgetFilter(Request $request)
    {
        return ProjectCollection::collection(Project::whereBetween('budget',$request->get('bq'))->orderBy('id', 'desc')->get());
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

        $tagsId=$request->get('tag');
        for($i=0;$i<count($tagsId);$i++){
            $project->tags()->attach($request->tag[$i]);
        }

        $uploadedFiles=$request->attachs;
        foreach($uploadedFiles as $file){
            $imageName=$file->store('projects_attachments', 's3');
             Storage::disk('s3')->setVisibility($imageName, 'public');
            $attachment = new ProjectAttachment;
            $attachment->project_id=$project->id;
            $attachment->name=basename($imageName);
            $attachment->link=Storage::disk('s3')->url($imageName);
            $attachment->save();
        }



        return response(['status'=>'success'],200);
    }

}
