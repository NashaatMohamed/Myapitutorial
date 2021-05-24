<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['middleware' => ['api','checkpassword','checklang'], 'namespace' => 'App\Http\Controllers\Api'], function (){
    Route::POST('getcatogry','maincatogry@index');
    Route::POST('getcatogrybyid','maincatogry@getcatogryById');
    Route::POST('change_status','maincatogry@changestatus');
    Route::group(['prefix' => 'admin'],function (){
       Route::post('login','authcontroller@login');
        Route::post('logout','authcontroller@logout') -> middleware('auth.guard:admin_api');
    });

});
Route::group(['middleware' => ['api','checkpassword','checklang','CheckAdminPassword:admin_api'], 'namespace' => 'App\Http\Controllers\Api'], function () {
    Route::get('offer', 'maincatogry@changestatus');
});
