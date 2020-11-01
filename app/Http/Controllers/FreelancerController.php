<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\Freelancer\FreelancerCollection;
use App\Category;

class FreelancerController extends Controller
{
    public function all(){

        return FreelancerCollection::collection(User::orderBy('id', 'desc')->where('role_name','freelancer')->paginate(18));

    }

    public function search(Request $request)
    {
        $resultsSearch=[];
        $error = ['error' => 'No results found, please try with different keywords.'];

        if ($request->has('q')) {


            $usersearchall=User::where('first_name', 'like', '%' . $request->get('q') . '%')->orWhere('last_name', 'like', '%' . $request->get('q') . '%')->get();
            $userId= $usersearchall->where('role_name','freelancer')->pluck('id')->toArray();

            for($i = 0; $i < count($userId); $i++){
                $UserFindSearch= new FreelancerCollection(User::find($userId[$i]));
                array_push($resultsSearch, $UserFindSearch);
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
        $freelnacersId=[];
         $categoryId = Category::whereIn('name', $request->get('cq'))->pluck('id')->toArray();
         for($i = 0; $i < count($categoryId); $i++){
            $categoryfind = Category::find($categoryId[$i]);
            $freelancersIdResultsId= $categoryfind->users()->where('role_name','freelancer')->pluck('id')->toArray();
            array_push($freelnacersId, $freelancersIdResultsId);
         }

         $freelnacersIdMerged = array_merge(...$freelnacersId);

         for($i=0;$i<count($freelnacersIdMerged);$i++){
           $freelancerfindFind= new FreelancerCollection(User::find($freelnacersIdMerged[$i]));
           array_push($results, $freelancerfindFind);

         }
        return $results;

    }

}