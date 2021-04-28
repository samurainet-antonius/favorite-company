<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMailable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $userDetail = User::where('email',$request->email)
                            ->whereNotNull('email_verified_at')
                            ->first();

        $is_unique = '';

        if($userDetail){
            $is_unique = '|unique:users';
        }


        $this->validate($request,[
            'name'      => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'email'     => 'required|email'.$is_unique,
            'password'  => 'required|min:6'
            
        ],[
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.regex' => 'The name must only contain letters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
        ]);

        $token = Str::random(32);

         $newUser = new User();
         $newUser->name = $request->name;
         $newUser->email = $request->email;
         $newUser->password = bcrypt($request->password);
         $newUser->remember_token = $token;
         if($newUser->save()){
             
             Mail::to($request->email)->send(new RegisterMailable($newUser));

            return response()->json(['success' => 'You have successfully registered, please check your email to activate your account'],'200');   
         }

         return response()->json(['error' => 'You have failed to register your account'],'400');   
        
    }
}
