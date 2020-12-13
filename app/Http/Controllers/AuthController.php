<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Tag;
use App\Balance;
// use Illuminate\Http\Client\Request;
use Illuminate\Http\Request;

// use GuzzleHttp\Psr7\Request;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'update', 'userImageStore','me']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        $role = "admin";

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (auth()->user()->role_name == $role) {
            return response()->json(['error' => 'this account is admin'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register()
    {
        $user = new User;
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->phone_number = request('phone_number');
        $user->password = Hash::make(request('password'));
        $user->role_name = request('role_name');
        $user->location = request('location');
        $user->category_id = request('category_id');
        $user->rate = request('rate');
        $user->user_img = request('user_img');




        $user->save();

        $Balance = new Balance;

        $Balance->total = 0;
        $Balance->withdrawable = 0;
        $Balance->outstanding = 0;
        $Balance->under_review = 0;
        $Balance->user_id = $user->id;



        $user->balance()->save($Balance);

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

    public function update(Request $request)
    {



        $user = Auth::user();

        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->phone_number = request('phone_number');
        $user->location = request('location');
        $user->gender = request('gender');
        $user->category_id = request('category_id');
        $user->about = request('about');

        $user->save();

        $user = User::find($user->id);
        $user->tags()->sync(request('tags_id'));


        return response()->json([
            'status' => 'user profile was updated',
            'user' => auth()->user()
        ], 200);
    }

    public function userImageStore(Request $request)
    {

        $token = $request->header('Authorization', $request->bearerToken());

        if ($token != null) {
            if (Auth::check()) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('users_images'), $imageName);
                $user = Auth::user();
                $user->user_img = $imageName;
                $user->save();
                return response()->json([
                    'img_name' => $imageName,
                    'success' => 'You have successfully upload image.',
                ]);
            } else {
                return response()->json([
                    'auth_check' => 'unauthorized',
                ]);
            }
        }else{
            return response()->json([
                'token' => 'not_found',
            ]);
        }
    }

    public function updateWebsiteData(Request $request){
        $token = $request->header('Authorization', $request->bearerToken());
        $user = Auth::user();

        if($token != null){
            if(Auth::check()){



                if($request->has('tags_id')){
                    $user = User::find($user->id);
                    // $user->tags()->attach($beer_id);
                    $user->tags()->sync(request('tags_id'));
                }


                return response()->json([
                    'success' => 'website info updated',
                ], 200);

            }else{
                return response()->json([
                    'not checked' => 'user unchecked',
                ], 200);
            }
        }else{
            return response()->json([
                'token' => 'token invalid',
            ], 200);
        }
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
            'user' => auth()->user()
        ]);
    }
}
