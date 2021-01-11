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
        return $user->received; // All messages received by this user
    }

    public function sent(Request $request){
        $userId=$request->get('user_id');
        $user=User::find($userId);
        return $user->sent;       // All messages sent by this user
    }

    public function conversation(Request $request){
        $sender_id=auth()->user()->id;
        $sent_to_id=$request->get('sent_to_id');

        return Message::where('sender_id',$sender_id)->where('sent_to_id',$sent_to_id)->orderBy('id', 'desc')->get();
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
