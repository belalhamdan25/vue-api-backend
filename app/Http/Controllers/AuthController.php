<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use GuzzleHttp\Psr7\Request;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        $role="admin";

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if(auth()->user()->role_name==$role){
            return response()->json(['error' => 'this account is admin'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(){
        $user = new User;
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->phone_number = request('phone_number');
        $user->password = Hash::make(request('password'));
        $user->role_name = request('role_name');
        $user->save();

        // User::create([
        //     'first_name' => request('first_name'),
        //     'last_name' => request('last_name'),
        //     'email' => request('email'),
        //     'phone_number' => request('phone_number'),
        //     'password' => Hash::make(request('password')),
        //     'role_name' => request('role_name'),
        // ]);

        return $this->login(request());
    }



    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function update()
    {
        // auth()->user()->update($request->all());
        $user = Auth::user();



        $UserChanges =[
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
          ];


        $user = Auth::user();

        $user->update($UserChanges);

        return response()->json([
            'status' => 'user profile was updated',
            'user'=>auth()->user()
        ],200);

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user'=>auth()->user()
        ]);
    }
}
