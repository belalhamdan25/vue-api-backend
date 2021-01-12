<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
class MessageController extends Controller
{

    public function allMessages(Request $request){
        return Message::all();
    }

    public function received(Request $request){
        $userId=$request->get('user_id');
        $user=User::find($userId);
        $users_idsender_id= $user->received->pluck('sender_id')->unique()->toArray(); // All messages received by this user
        $users_idsent_to_id= $user->received->pluck('sent_to_id')->unique()->toArray(); // All messages received by this user

        $result = array_merge($users_idsender_id, $users_idsent_to_id);
        return User::find($result);

    }

    // public function sent(Request $request){
    //     $userId=$request->get('user_id');
    //     $user=User::find($userId);
    //     return $user->sent;       // All messages sent by this user
    // }

    public function conversation(Request $request){
        $sender_id=auth()->user()->id;
        $sent_to_id=$request->get('sent_to_id');

        return Message::where('sender_id',$sender_id)->where('sent_to_id',$sent_to_id)->orWhere('sent_to_id',$sender_id)->Where('sender_id',$sent_to_id)->orderBy('id', 'asc')->get();
    }


    public function store(Request $request){
        $newMessage=New Message;
        $newMessage->sender_id = $request->get('sender_id');
        $newMessage->sent_to_id = $request->get('sent_to_id');
        $newMessage->body = $request->get('body');
        $newMessage->save();
        return response()->json([
            'status' => 'Message Sent',
        ]);
    }


}
