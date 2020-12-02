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



Route::get('/', function () {
    return auth()->check() ? view('welcome') : view('auth.login');
});

Auth::routes();

// Me route
Route::get('/me', ['middleware' => 'auth', function () {

    $role =  \App\Models\User::where('id',auth()->user()->id )->first()->load('role');
     // $role = Role::where('id', $user->role->id)->first();
    $permissions = \App\Models\Permiso::where('rol_id', auth()->user()->id )->with('maestro')->get();
    return ['role' => $role, 'permisos' => $permissions];


}] );

Route::post('graphql/login', 'AuthenticateController@authenticate');
Route::post('graphql/logout', 'AuthenticateController@logout');


//Clear Cache facade value:
Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return '<h1>Cache facade value cleared</h1>';
});


//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

// API
Route::group(['prefix'=>'api'],function(){
  // producto
 /* Route::post('Producto/create','ProductoController@create');
  Route::post('Companie/create','CompanieController@create');
  Route::post('Producto/edit','ProductoController@edit');
  Route::get('IsUser','ApiController@IsUser');
  Route::get('Tables','ApiController@Tables');
  Route::get('Companys','ApiController@Companys');

  Route::get('Permissions','ApiController@Permissions');
  
  Route::get('Proyectos','ApiController@Proyectos')->name('Proyectos');
  Route::get('ProyectoById/{id}','ApiController@Proyecto')->name('Proyecto');
  Route::post('CreateProyecto','ApiController@CreateProyecto')->name('CreateProyecto');
  Route::post('UpdateProyecto','ApiController@UpdateProyecto')->name('UpdateProyecto');
  Route::put('BlockedProyecto/{id}/{status}','ApiController@BlockedProyecto')->name('BlockedProyecto');
  Route::delete('DeleteProyecto/{id}','ApiController@DeleteProyecto')->name('DeleteProyecto');


  Route::get('Users','ApiController@Users');
  Route::get('UserById/{id}','ApiController@User')->name('User');
  Route::post('CreateUser','ApiController@CreateUser')->name('CreateUser');
  Route::post('UpdateUser','ApiController@UpdateUser')->name('UpdateUser');
  Route::put('BlockedUser/{id}/{status}','ApiController@BlockedUser')->name('ordenes.BlockedUser');
  Route::delete('DeleteUser/{id}','ApiController@DeleteUser')->name('ordenes.DeleteUser');


  Route::get('Roles','ApiController@Roles');
  Route::get('GetRoleInfo/{id}','ApiController@GetRoleInfo');
  Route::get('RoleById/{id}','ApiController@Role');
  Route::post('CreateRole','ApiController@CreateRole');
  Route::post('UpdateRole','ApiController@UpdateRole');
  Route::put('BlockedRole/{id}/{status}','ApiController@BlockedRole');
  Route::delete('DeleteRole/{id}','ApiController@DeleteRole');


  Route::get('Objetivos','ApiController@Objetivos');
  Route::get('ObjetivoById/{id}','ApiController@Objetivo');
  Route::post('CreateObjetivo','ApiController@CreateObjetivo');
  Route::post('UpdateObjetivo','ApiController@UpdateObjetivo');
  Route::put('BlockedObjetivo/{id}/{status}','ApiController@BlockedObjetivo');
  Route::put('CompletObjetivo/{id}/{status}','ApiController@CompletObjetivo');
  Route::delete('DeleteObjetivo/{id}','ApiController@DeleteObjetivo');
  

  Route::get('Palancas','ApiController@Palancas');
  Route::get('PalancaById/{id}','ApiController@Palanca');
  Route::post('CreatePalanca','ApiController@CreatePalanca');
  Route::post('UpdatePalanca','ApiController@UpdatePalanca');
  Route::put('BlockedPalanca/{id}/{status}','ApiController@BlockedPalanca');
  Route::delete('DeletePalanca/{id}','ApiController@DeletePalanca');
  Route::put('CompletPalanca/{id}/{status}','ApiController@CompletPalanca');


  Route::get('Experimentos','ApiController@Experimentos');
  Route::get('ExperimentoById/{id}','ApiController@Experimento');
  Route::post('CreateExperimento','ApiController@CreateExperimento');
  Route::post('UpdateExperimento','ApiController@UpdateExperimento');
  Route::put('BlockedExperimento/{id}/{status}','ApiController@BlockedExperimento');
  Route::delete('DeleteExperimento/{id}','ApiController@DeleteExperimento');
  Route::put('CompletExperimento/{id}/{status}','ApiController@CompletExperimento');


  Route::get('Campanas','ApiController@Campanas');
  Route::get('CampanaById/{id}','ApiController@Campana');
  Route::post('CreateCampana','ApiController@CreateCampana');
  Route::post('UpdateCampana','ApiController@UpdateCampana');
  Route::put('BlockedCampana/{id}/{status}','ApiController@BlockedCampana');
  Route::delete('DeleteCampana/{id}','ApiController@DeleteCampana');
  Route::put('CompletCampana/{id}/{status}','ApiController@CompletCampana');*/
  


});
