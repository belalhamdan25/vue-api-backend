<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\ProjectOffer;

class AdminController extends Controller
{
    public function index(){

        $usersCount=User::all()->count();
        $projectsCount=Project::all()->count();
        $offersCount=ProjectOffer::all()->count();

        return view('index',compact('usersCount','projectsCount','offersCount'));
    }
}
