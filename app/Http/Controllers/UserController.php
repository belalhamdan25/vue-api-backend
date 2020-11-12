<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use App\User;

class UserController extends Controller
{
    public function userShow(User $id)
    {
        return new UserResource($id);

    }
}
