<?php

use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function (){

    $data=[
        'event'=>'UserSignedUp',
        'data'=>[
            'username'=>'moWagdy'
        ]
    ];

Redis::publish('test-channel',json_encode($data));


return view('welcomeSocket');
});



//Route::get('/', 'HomeController@index');
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');

/*
* Admin Dashbord Routes
*/
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'role:admin']], function () {
	Route::get('/', [
		'uses' => 'Dashboard\HomeController@index',
		'as' => 'index'
	]);

	Route::resource('users', 'Dashboard\UserController');
	Route::resource('drivers', 'Dashboard\DriverController');
	Route::resource('carOwners', 'Dashboard\CarOwnerController');
	Route::resource('cars', 'Dashboard\CarController');






	Route::get('admins', [
    'as' => 'admins.all',
    'uses' => 'Dashboard\UserController@adminAll'
	]);

	Route::get('dashboard/create/admin', [
    'as' => 'admin.create.admin',
    'uses' => 'Dashboard\UserController@createAdmin'
	]);


	Route::post('admin/users/deactivate', [
    'as' => 'admin.deactivate.user',
    'uses' => 'Dashboard\UserController@deactivate'
	]);

	Route::post('admin/users/activate', [
    'as' => 'admin.activate.user',
    'uses' => 'Dashboard\UserController@activate'
	]);

	Route::post('admin/users/make/admin', [
    'as' => 'admin.make.admin',
    'uses' => 'Dashboard\UserController@makeAdmin'
	]);

	Route::post('admin/users/remove/admin', [
    'as' => 'admin.remove.admin',
    'uses' => 'Dashboard\UserController@removeAdmin'
	]);

	Route::post('dashboard/store/admin', [
    'as' => 'admin.store.admin',
    'uses' => 'Dashboard\UserController@storeAdmin'
	]);

	Route::get('owner/add/car', [
    'as' => 'admin.add.car.owner',
    'uses' => 'Dashboard\CarOwnerController@storeCar'
	]);

});
