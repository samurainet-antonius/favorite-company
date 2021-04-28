<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyController extends Controller
{
    public function verify(Request $request){

        $user = User::where('remember_token',$request->token)
            ->whereNull('email_verified_at')->first();
        
        if($user){
            $user->email_verified_at = date("Y-m-d H:i:s");
            if($user->save()){
                return response()->json(['success' => 'You have successfully registered, please check your email to activate your account'],'200');
            }
            return response()->json(['error' => 'You have failed to register your account'],'400');
        }

        return response()->json(['error' => 'You have failed to register your account'],'400');

           
    }
}
