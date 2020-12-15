<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class BalanceController extends Controller
{
    public function charge(Request $request){
        $user = Auth::user();
        $user->balance = $user->balance + request('amount');
        $user->save();
        return response()->json([
            'status' => 'balance charged',
        ], 200);
    }
}
