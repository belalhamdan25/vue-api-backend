<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\Freelancer\FreelancerCollection;


class FreelancerController extends Controller
{
    public function all(){

        return FreelancerCollection::collection(User::orderBy('id', 'desc')->where('role_name','freelancer')->paginate(18));

    }
}
