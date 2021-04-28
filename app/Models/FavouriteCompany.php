<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Company;
class FavouriteCompany extends Model
{
    protected $table = 'favouritecompany';

    protected $fillable = [
        'user_id',
        'company_id',
    ];

    public static function notFavouriteCompany($xMember){

        $favourite = (new static)->where('user_id',$xMember)->get();

        $companies = array();
        foreach($favourite as $value){
            $companies[] = $value['company_id'];
        }

        return Company::whereNotIn('id',$companies)->get();

    }
}
