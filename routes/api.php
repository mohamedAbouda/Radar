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
Route::post('/register', [
	'uses' => 'Apis\AuthController@register',
]);

Route::post('/login', [
	'uses' => 'Apis\AuthController@login',
]);

Route::post('/social/login', [
	'uses' => 'Apis\AuthController@socialLogin',
]);

Route::get('/categories', [
	'uses' => 'Apis\CategoryController@index',
]);

Route::get('/cousins', [
	'uses' => 'Apis\CousinController@index',
]);

Route::group(['middleware'=>['JWT.auth']],function (){

	Route::get('/cooks/profile',[
		'uses'=>'Apis\CookController@show'
	]);

	Route::post('/profile/edit',[
		'uses'=>'Apis\AuthController@update'
	]);

	Route::post('/location/update',[
		'uses'=>'Apis\AuthController@updateLocation'
	]);

	Route::post('/promo',[
		'uses'=>'Apis\AuthController@refer'
	]);

	Route::post('/invite',[
		'uses'=>'Apis\AuthController@invite'
	]);

	Route::post('/password/reset',[
		'uses'=>'Apis\AuthController@passwordReset'
	]);

	Route::post('/recipe/create',[
		'uses'=>'Apis\RecipeController@store'
	]);

	Route::post('/recipe/edit',[
		'uses'=>'Apis\RecipeController@update'
	]);

	Route::post('/recipe/delete',[
		'uses'=>'Apis\RecipeController@destroy'
	]);

	Route::post('/recipe/view',[
		'uses'=>'Apis\RecipeController@show'
	]);

	Route::post('/details/create',[
		'uses'=>'Apis\AuthController@moreDetails'
	]);

	Route::post('/category/recipes',[
		'uses'=>'Apis\CategoryController@show'
	]);

	Route::post('/search/recipes',[
		'uses'=>'Apis\RecipeController@search'
	]);

	Route::post('/order/create',[
		'uses'=>'Apis\OrderController@store'
	]);

	Route::post('/order/update',[
		'uses'=>'Apis\OrderController@update'
	]);
});

