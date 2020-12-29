<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\ProjectOffer;

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
        return view('index');
    }

    public function logout(){
        auth('web')->logout();
        return redirect('/login');
    }
}
