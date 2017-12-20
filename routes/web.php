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

Auth::routes();


Route::get('socket', 'HomeController@updateLocation');

Route::get('listen/{id}', 'HomeController@listenLocation');

Route::get('location/{id}', 'HomeController@getLocation');

//verfiy the User
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Apis\AuthController@confirm'
]);

//approve group request
Route::get('group/request/verfiy/{confirmationCode}', [
    'as' => 'accept_request',
    'uses' => 'Apis\GroupController@confirm'
]);




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

    Route::get('location/map/{lat?}/{lng?}', function($lat , $lng) {
        $parameters = "$lat,$lng";
        return view('dashboard.map' , compact('parameters'));
    })->name('location.simpleMap');

    Route::get('radars/all/map','Dashboard\RadarController@allOnMap')->name('radar.allOnMap');
    Route::resource('radar','Dashboard\RadarController');
    Route::resource('locations','Dashboard\LocationController');

    Route::get('lagnas/reports/{report}/edit' , 'Dashboard\LagnaController@editReport')->name('lagnas.reports.edit');
    Route::patch('lagnas/reports/{report}/edit' , 'Dashboard\LagnaController@updateReport')->name('lagnas.reports.update');
    Route::delete('lagnas/reports/{report}/delete' , 'Dashboard\LagnaController@destroyReport')->name('lagnas.reports.destroy');
    Route::resource('lagnas','Dashboard\LagnaController');

    Route::resource('towtrucks','Dashboard\TowTruckController');
    Route::resource('accidents','Dashboard\AccedentController');
    Route::resource('helprequests','Dashboard\HelpRequestController');
    Route::resource('news','Dashboard\NewsFeedController');
    Route::resource('carmodels','Dashboard\CarModelController');
});
