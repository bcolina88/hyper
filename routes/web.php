<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return auth()->check() ? view('dashboard') : view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Me route
Route::get('/me', ['middleware' => 'auth', function () {
    return \App\Models\User::find(auth()->user()->id);
}] );*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('graphql/login', 'AuthenticateController@authenticate');
Route::post('graphql/logout', 'AuthenticateController@logout');

// //Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

// //Clear Cache facade value:
Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return '<h1>Cache facade value cleared</h1>';
});


// API
Route::group(['prefix'=>'api'],function(){

  Route::post('profile', 'ProfileController@updateProfilePicture');

});