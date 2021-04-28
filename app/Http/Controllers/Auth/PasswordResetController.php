<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMailable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordResetController extends Controller
{
    public function requestToken(Request $request){

        $this->validate($request,[
            'email'     => 'required|email'
            
        ],[
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
        ]);

        $user = User::where('email',$request->email)->first();

        if($user){

            $userActive = User::where('email',$request->email)
                            ->whereNotNull('email_verified_at')
                            ->first();
            if($userActive){
                $token = Str::random(32);
                $userActive->remember_token = $token;
                if($userActive->save()){

                    $passwordReset['token'] = $token;
                    $passwordReset['email'] = $request->email;
                    PasswordReset::insert($passwordReset);

                    Mail::to($request->email)->send(new PasswordResetMailable($userActive));

                    return response()->json(['success' => 'Password change link has been sent, please check your email to make a change of password.'],200);        
                }

                return response()->json(['error' => 'Request send token for password change failed to send.'],400);
            }

            return response()->json(['error' => 'Your account is not active yet, please activate it in advance so that it can be used.'],400);

        }

        return response()->json(['error' => 'Your email is not registered on our system.'],400);

    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'password'  => 'required|min:6',
            'confirm_password'  => 'required|min:6|same:password'
            
        ],[
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'confirm_password.required' => 'The confirm password field is required.',
            'confirm_password.min' => 'The confirm password must be at least 6 characters.',
            'confirm_password.same' => 'Your new password confirmation does not match.',
        ]);

        $user = User::where('remember_token',$request->token)->first();

        if($user){
                $token = Str::random(32);

                $credentials['email'] = $user->email;
                $credentials['password'] = $request->password;
                if(auth()->attempt($credentials)){

                    $userUpdate = User::where('id',$user->id)->update(
                        ['password' => bcrypt($request->password),'remember_token' => $token]);

                    return response()->json(['success' => 'The password change was done successfully. Now you can log in to your account with your new password.'],200);        
                }

                return response()->json(['error' => 'Password change failed.'],400);

        }

        return response()->json(['error' => 'Your password change token is not registered or has expired.'],400);
    }
}
