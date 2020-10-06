<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{
    public function roles(){

        $rolesName = Role::all()->pluck('name')->toArray();
        $sliced = array_slice($rolesName, 1); // array without last element (admin)
        return $sliced;
    }
}
