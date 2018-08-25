<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Route::group([

    'middleware' => 'jwt.auth',

], function ($router) {

//Projects api routes
    Route::post('projects', 'API\projectController@store');
    Route::put('projects/{project}', 'API\projectController@update');
    Route::delete('projects/{project}', 'API\projectController@delete');
    Route::post('user/img', function(Request $request){
        $user= \App\User::findOrFail(auth()->user()->id);
        $path = $request->file('img')->store('public/images');
        $path= str_replace("public/","",$path);
        $user->img= $path;
        $user->save();
        return response()->json($user->load('favorites', 'projects', 'jointprojects'));
    });

    Route::post('user/edit', function(Request $request){
        $user= \App\User::findOrFail(auth()->user()->id);
        $user->country= $request->country;
        $user->city= $request->city;
        $user->phone= $request->phone;
        $user->description= $request->description;
        $user->money= $request->money;
        $user->facebook= $request->facebook;
        $user->twitter= $request->twitter;
        $user->linkedin= $request->linkedin;
        $user->save();
        return response()->json($user->load('favorites', 'projects', 'jointprojects'));
    });

});

//View Users
Route::get('users', function(){
    return \App\User::all();
});
//View User By ID
Route::get('user/{id}', function($id){
    return \App\User::findOrFail($id);
});


//View Memberships
Route::get('memberships', function(){
    return \App\Membership::all();
});
//View Membership By ID
Route::get('membership/{id}', function($id){
    return \App\Membership::findOrFail($id);
});


//View Services
Route::get('services', function(){
    return \App\Service::all();
});
//View Service By ID
Route::get('service/{id}', function($id){
    return \App\Service::findOrFail($id);
});

