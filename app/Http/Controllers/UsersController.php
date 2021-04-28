<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\FavouriteCompany;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMailable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    
    public function favouriteCompanies(Request $request){
        $token_jwt = $request->header('Authorization');
        $xMember = $request->header('x-member');

        if(!$token_jwt || !$xMember){
            return response()->json([
                'error' => 'Who are you ?.' 
            ],400);    
        }
        
        $favouriteCompanies = FavouriteCompany::where('user_id',$xMember)
                        ->join('companies','favouritecompany.company_id','=','companies.id')
                        ->get();

        if(!empty($favouriteCompanies)){
            return $favouriteCompanies;
        }

        return response()->json([
            'error' => 'Favourite company not found.' 
        ],400);
    }

    public function addFavourite(Request $request){
        $token_jwt = $request->header('Authorization');
        $xMember = $request->header('x-member');

        if(!$token_jwt || !$xMember){
            return response()->json([
                'error' => 'Who are you ?.' 
            ],400);    
        }

        $company = $request->company;
        foreach($company as $key => $company_id){
            $addFavourite[$key]['user_id'] = $xMember;
            $addFavourite[$key]['company_id'] = $company_id;
        }
        $save = FavouriteCompany::insert($addFavourite);
        if($save){
            
            return response()->json(['success' => 'The company was successfully included in your favorites list.'], 200);
        }

        return response()->json(['success' => 'The company failed to be included in your favorites list.'], 400);
    }

    public function removeFavourite(Request $request){

        $company = $request->company;

        FavouriteCompany::where('user_id',$request->x_member)
                                ->whereIn('company_id',$company)->delete();
            
        return response()->json(['success' => 'The company was successfully removed from your favorites list.'], 200);
    }
}
