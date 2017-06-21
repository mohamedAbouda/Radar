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
});
