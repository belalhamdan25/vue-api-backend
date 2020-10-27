<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Resources\Projects\ProjectCollection;
use App\Http\Resources\Projects\ProjectResource;

use App\Category;
use App\Tag;

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
         $categoryId = Category::whereIn('name', $request->get('cq'))->pluck('id')->toArray();
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

}
