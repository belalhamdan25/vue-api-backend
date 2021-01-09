<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class MessageController extends Controller
{
    public function received(Request $request){
        $userId=$request->get('user_id');
        $user=User::find($userId);
        return $user->received; // All messages received by this user
    }

    public function sent(Request $request){
        $userId=$request->get('user_id');
        $user=User::find($userId);
        return $user->sent;       // All messages sent by this user
    }
}
