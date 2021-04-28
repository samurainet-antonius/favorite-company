<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\Auth\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/companies',[CompaniesController::class,'index']);

Route::prefix('/auth')->group(function() {
    Route::post('/login',[LoginController::class,'login']);
    Route::post('/register',[RegisterController::class,'register']);
    Route::post('/verify',[VerifyController::class,'verify']);
    Route::post('/requestToken',[PasswordResetController::class,'requestToken']);
    Route::post('/changePassword',[PasswordResetController::class,'changePassword']);
});

Route::group(['middleware' => 'api'], function(){
    Route::get('user/companies', [UsersController::class,'favouriteCompanies']);
    Route::post('user/addFavourite', [UsersController::class,'addFavourite']);
    Route::delete('user/removeFavourite', [UsersController::class,'removeFavourite']);
    Route::post('logout', [UsersController::class,'logout']);
});
