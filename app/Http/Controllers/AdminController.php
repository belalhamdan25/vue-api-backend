<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\ProjectOffer;
use App\Portfolio;

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
    public function projectsCreate(){
        $projects=Project::orderBy('id', 'desc')->paginate(10);

        return view('projects',compact('projects'));
    }

    public function offersCreate(){
        $offers=ProjectOffer::orderBy('id', 'desc')->paginate(10);

        return view('offers',compact('offers'));
    }
    public function portfoliosCreate(){
        $portfolios=Portfolio::orderBy('id', 'desc')->paginate(10);

        return view('portfolios',compact('portfolios'));
    }
}
