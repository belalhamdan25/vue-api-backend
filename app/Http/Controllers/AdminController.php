<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\ProjectOffer;
use App\Portfolio;
use App\Tag;
use App\Category;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{

    public function loginCreate()
    {
        return view('login');
    }
    public function loginStore()
    {
        if (!auth('web')->attempt(request(['email', 'password']))) {

            return back()->withErrors([

                'massage' => 'Email or password are incorrect !'
            ]);

        } else if (auth('web')->attempt(request(['email', 'password']))) {

            if (auth('web')->user()->role_name == "admin") {
                return redirect('/');
            } else {

            return back()->withErrors([
                'massage' => 'Email or password are incorrect !'
            ]);

            }
        }
    }

    public function index()
    {
        $usersCount=User::all()->count();
        $projectCount=Project::all()->count();
        $projectOfferCount=ProjectOffer::all()->count();
        $portfolioCount=Portfolio::all()->count();



        return view('index',compact('usersCount','projectCount','projectOfferCount','portfolioCount'));
    }

    public function logout(){
        auth('web')->logout();
        return redirect('/login');
    }

    public function usersCreate(){
        $users=User::orderBy('id', 'desc')->paginate(20);

        return view('users',compact('users'));
    }
    public function usersDelete(User $id){
        if ($id->role_name == "admin") {
            return redirect()->back()->with('adminDelete', 'You cannot delete admin');
        } else {
            $id->delete();
            return redirect()->back()->with('userDeleted', $id->email);
        }
    }

    public function usersResetPass(User $id)
    {
        $id->password = Hash::make("1234567890");
        $id->save();

        return redirect()->back()->with('successfulReset', $id->email . ' ' . 'Reset Successful .. password reset is 1234567890');
    }

    public function usersSearch(Request $request)
    {
        $usersSearch = User::where('email', 'like', '%' . $request->get('usersSearch') . '%')->paginate(10);
        return view('users-search',compact('usersSearch'));

    }

    public function projectsCreate(){
        $projects=Project::orderBy('id', 'desc')->paginate(10);

        return view('projects',compact('projects'));
    }

    public function projectsDelete(Project $id){
        $id->delete();
        return redirect()->back()->with('ProjectDelete', $id->title. ' Deleted ' );
    }

    public function offersCreate(){
        $offers=ProjectOffer::orderBy('id', 'desc')->paginate(10);

        return view('offers',compact('offers'));
    }

    public function offersDelete(ProjectOffer $id){
        $id->delete();
        return redirect()->back()->with('ProjectOfferDelete', ' Deleted ' );
    }

    public function portfoliosCreate(){
        $portfolios=Portfolio::orderBy('id', 'desc')->paginate(10);

        return view('portfolios',compact('portfolios'));
    }

    public function portfoliosDelete(Portfolio $id){
        $id->delete();
        return redirect()->back()->with('PortfolioDelete', ' Deleted ' );
    }

    public function skillsCreate(){
        $skills=Tag::orderBy('id', 'desc')->paginate(10);

        return view('skills',compact('skills'));
    }

    public function skillsStore(){
        $skill=New Tag;
        $skill->name=request('skill');
        $skill->save();
        return redirect()->back()->with('successfulSkillAdd : ', $skill->name);

    }
    public function skillsDelete(Tag $id){
        $id->delete();
            return redirect()->back()->with('TagDeleted', $id->name. ' Deleted ' );
    }

    public function categoryCreate(){
        $categories=Category::orderBy('id', 'desc')->paginate(10);

        return view('category',compact('categories'));
    }
    public function categoryStore(){
        $category=New Category;
        $category->name=request('category');
        $category->desc=request('category');
        $category->save();
        return redirect()->back()->with('successfulcategoriesAdd : ', $category->desc);

    }

    public function categoryDelete(Category $id){
        $id->delete();
            return redirect()->back()->with('CategoryDelete', $id->desc. ' Deleted ' );
    }

}
