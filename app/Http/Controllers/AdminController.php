<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\ProjectOffer;
use App\Portfolio;
use App\Tag;
use App\Category;
use App\Role;
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
        $users=User::orderBy('id', 'desc')->with('category')->paginate(20);
        $roles=Role::all();
        $categories=Category::all();

        return view('users',compact('users','roles','categories'));
    }
    public function usersDelete(User $id){
        if ($id->role_name == "admin") {
            return redirect('/users')->with('adminDelete', 'You cannot delete admin');
        } else {
            $id->delete();

            return redirect('/users')->with('userDeleted', $id->email . ' ' . 'Deleted');

        }
    }

    public function usersResetPass(User $id)
    {
        $id->password = Hash::make("1234567890");
        $id->save();

        return redirect('/users')->with('successfulReset', $id->email . ' ' . 'Reset Successful .. password reset is 1234567890');
    }


    public function usersSearch(Request $request)
    {
        $usersSearch = User::where('email', 'like', '%' . $request->get('usersSearch') . '%')->paginate(10);
        return view('users-search',compact('usersSearch'));

    }

    public function usersAdd(Request $request)
    {
        $user = new User;
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->phone_number = request('phone_number');
        $user->password = Hash::make(request('password'));
        $user->role_name = request('role_name');
        $user->location = request('country');
        $user->category_id = request('category_id');

        $user->save();

        return redirect('/users')->with('successfulAddUser', $user->email . ' ' . 'Add Successful');

    }


    public function projectsCreate(){
        $projects=Project::with('category','user')->orderBy('id', 'desc')->paginate(10);

        return view('projects',compact('projects'));
    }

    public function projectsDelete(Project $id){
        $id->delete();
        return redirect('/projects')->with('ProjectDelete', $id->title. ' Deleted ' );
    }


    public function projectsEditCreate(Project $id){

        $categories=Category::all();

        return view('projects_edit',compact('id','categories'));
    }

    public function projectsEditUpdate(Project $id){

        $id->title = request('title');
        $id->budget = request('budget');
        $id->time_line = request('time_line');
        $id->category_id = request('category_id');
        $id->desc = request('desc');

        $id->save();

        return redirect()->back()->with('successfulEdit', $id->title . ' ' . 'Edit Successful');
    }

    public function projectSearch(Request $request)
    {
        $projectSearch = Project::where('title', 'like', '%' . $request->get('projectSearch') . '%')->paginate(10);
        return view('project-search',compact('projectSearch'));

    }


    public function offersCreate(){
        $offers=ProjectOffer::orderBy('id', 'desc')->with('user')->paginate(10);

        return view('offers',compact('offers'));
    }

    public function offersDelete(ProjectOffer $id){
        $id->delete();
        return redirect('/offers')->with('ProjectOfferDelete', ' Deleted ' );
    }

    public function offersEditCreate(ProjectOffer $id){



        return view('offers_edit',compact('id'));
    }

    public function offersEditUpdate(ProjectOffer $id){

        $id->timeline = request('timeline');
        $id->profit = request('profit');
        $id->coast = request('coast');
        $id->desc = request('desc');

        $id->save();

        return redirect()->back()->with('successfulEdit', $id->title . ' ' . 'Edit Successful');
    }

    public function offerSearch(Request $request)
    {
        $offerSearch = Project::where('desc', 'like', '%' . $request->get('offerSearch') . '%')->paginate(10);
        return view('offer-search',compact('offerSearch'));

    }

    public function portfoliosCreate(){
        $portfolios=Portfolio::orderBy('id', 'desc')->with('user','category')->paginate(10);

        return view('portfolios',compact('portfolios'));
    }

    public function portfoliosDelete(Portfolio $id){
        $id->delete();
        return redirect('portfolios')->with('PortfolioDelete', ' Deleted ' );
    }

    public function portfolioEditCreate(Portfolio $id){

        $categories=Category::all();


        return view('portfolio_edit',compact('id','categories'));
    }

    public function portfolioEditUpdate(Portfolio $id){

        $id->title = request('title');
        $id->link = request('link');
        $id->date = request('date');
        $id->category_id = request('category_id');
        $id->desc = request('desc');

        $id->save();

        return redirect()->back()->with('successfulEdit', $id->title . ' ' . 'Edit Successful');
    }

    public function portfolioSearch(Request $request)
    {
        $portfolioSearch = Portfolio::where('title', 'like', '%' . $request->get('portfolioSearch') . '%')->paginate(10);
        return view('portfolio-search',compact('portfolioSearch'));

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
            return redirect('skills')->with('TagDeleted', $id->name. ' Deleted ' );
    }

    public function skillsEditCreate(Tag $id){



        return view('skills_edit',compact('id'));
    }
    public function skillsEditUpdate(Tag $id){

        $id->name = request('skills');


        $id->save();

        return redirect('skills')->with('successfulEdit', $id->name . ' ' . 'Edit Successful');
    }

    public function skillsSearch(Request $request)
    {
        $skillsSearch = Tag::where('name', 'like', '%' . $request->get('skillsSearch') . '%')->paginate(10);
        return view('skills-search',compact('skillsSearch'));

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
            return redirect('category')->with('CategoryDelete', $id->desc. ' Deleted ' );
    }

    public function categoryEditCreate(Category $id){



        return view('category_edit',compact('id'));
    }
    public function categoryEditUpdate(Category $id){

        $id->name = request('category');
        $id->desc = request('category');


        $id->save();

        return redirect()->back()->with('successfulEdit', $id->desc . ' ' . 'Edit Successful');
    }

    public function categorySearch(Request $request)
    {
        $categorySearch = Category::where('desc', 'like', '%' . $request->get('categorySearch') . '%')->paginate(10);
        return view('category-search',compact('categorySearch'));

    }

}
