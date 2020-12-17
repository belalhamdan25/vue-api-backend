<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Tag;
// use Illuminate\Http\Client\Request;
use Illuminate\Http\Request;
// use GuzzleHttp\Psr7\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'update', 'userImageStore', 'me', 'forGotPassword']]);
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
        $user->balance = 0;




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

        $user->user_img = request('image');

        $userTag = User::find($user->id);
        $userTag->tags()->sync(request('tags_id'));
        $userTag->save();

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
        } else {
            return response()->json([
                'token' => 'not_found',
            ]);
        }
    }

    public function forGotPassword()
    {
        $email = request('email');
        $password = uniqid();
        $user_id=User::where('email',$email)->get('id');
        if($user_id->isNotEmpty()){
            $user = User::where('email', $email)
            ->first();
            $user->password=Hash::make($password);
            $user->save();

            $title = '[Reset Password] Worker';
            $user_details = [
                'password' => $password,
                'email' => $email
            ];

            $sendmail = Mail::to($user_details['email'])->send(new SendMail($title, $user_details));
            if (empty($sendmail)) {
                return response()->json(['message' => 'Password Reset Mail Sent Sucssfully'], 200);
            }else{
                return response()->json(['message' => 'Password Reset Mail Sent fail'], 400);
            }
        }else{
            return response()->json(['message' => 'Invalid Email Please Try Again !'], 400);
        }

    }

    public function updatePassword()
    {
        $Cpassword=request('Cpassword');
        $Npassword=request('Npassword');
        $CNpassword=request('CNpassword');



        if(Hash::check($Cpassword,Auth::user()->password)){
            if($Npassword == $CNpassword){
                $finalNewPass=$CNpassword;
                Auth::user()->password = Hash::make($finalNewPass);
                Auth::user()->save();
                return response()->json(['message' => 'Password Updated'], 200);

            }else{
                return response()->json(['message' => 'Invalid New Password Confirmation Please Try Again !'], 400);
            }
        }else{
            return response()->json(['message' => 'Invalid Current Password Confirmation Please Try Again !'], 400);
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
