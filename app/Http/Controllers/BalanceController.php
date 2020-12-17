<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transaction;
class BalanceController extends Controller
{
    public function charge(Request $request){
        $user = Auth::user();
        $user->balance = $user->balance + request('amount');
        $user->save();

        $transaction = new Transaction;
        $transaction->desc = "charge amount";
        $transaction->amount = request('amount');
        $transaction->user_id = $user->id;
        $transaction->save();

        return response()->json([
            'status' => 'balance charged',
        ], 200);
    }

}
