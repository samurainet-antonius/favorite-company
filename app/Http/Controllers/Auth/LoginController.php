<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request){

        $this->validate($request,[
            'email'     => 'required|email',
            'password'  => 'required|min:6'
            
        ],[
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'The password field is required.',
        ]);

        $userExists = User::where([
            ['email',$request->email],
            ['is_verified',1]
        ])->first();

        if($userExists){
            $user = User::where('email',$request->email)
            ->whereNotNull('email_verified_at')->first();    
            if($user){
                $credentials = $request->only('email','password');
                $credentials['is_verified'] = 1;
                if($token = auth()->attempt($credentials)){
                    return $this->generateToken($token);
                }
    
                return response()->json(['error' => 'You failed to login password and email does not match.'], 400);
            }

            return response()->json(['error' => 'Your account is not active yet, please activate your account first.'], 400);
        }

        return response()->json(['error' => 'Your email is not registered, please register in advance.'], 400);

    }

    
    /**
     * Sign out
    */
    public function signout() {
        auth()->logout();
        return response()->json(['message' => 'User loged out']);
    }

    /**
     * Token refresh
    */
    public function refresh() {
        return $this->generateToken(auth()->refresh());
    }

    /**
     * User
    */
    public function user() {
        return response()->json(auth()->user());
    }

    /**
     * Generate token
    */
    protected function generateToken($token){
        return response()->json([
            'success' => 'You successfully logged in, please access your account.',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ],200);
    }
}
