<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
/*Route::get('/', function () {
    return view('welcome');
});
Auth::routes();*/

Route::group(['name' => 'frontend'], function() {
	Route::group(['middleware' => 'guest:web'], function() {
		Route::get('login',['uses'=>'LoginController@login', 'as'=>'login']);
		Route::post('login',['uses'=>'LoginController@authlogin', 'as'=>'userlogin']);
		Route::get('register',['uses'=>'LoginController@register', 'as'=>'register']);
		Route::post('register',['uses'=>'LoginController@authregister', 'as'=>'userregister']);
		Route::get('fogotpassword',['uses'=>'LoginController@fogotpassword', 'as'=>'fogotpassword']);
		Route::post('fogotpassword',['uses'=>'LoginController@authfogotpassword', 'as'=>'userfogotpassword']);
		Route::get('passwordreset/{email}/{code}',['uses'=>'LoginController@passwordreset', 'as'=>'passwordreset']);
		Route::post('passwordreset/{email}/{code}',['uses'=>'LoginController@authpasswordreset', 'as'=>'userpasswordreset']);
	});
	Route::group(['middleware' => 'auth'], function() {
		Route::any('dashboard/{page?}/{action?}/{id?}',['uses'=>'UserController@index', 'as'=>'dashboard']);
		Route::post('addproduct',['uses'=>'UserController@addproduct', 'as'=>'addproduct']);
		Route::post('editproduct/{id}',['uses'=>'UserController@editproduct', 'as'=>'editproduct']);
		Route::get('delete_imageproduct/{id}/{img_id}',['uses'=>'UserController@delete_imageproduct', 'as'=>'delete_imageproduct']);
		Route::get('destroyproduct/{id}',['uses'=>'UserController@destroyproduct', 'as'=>'destroyproduct']);
		Route::get('statusproduct/{id}',['uses'=>'UserController@statusproduct', 'as'=>'statusproduct']);
		Route::post('profile',['uses'=>'UserController@profile', 'as'=>'profile']);
		Route::any('logout',['uses'=>'LoginController@logout', 'as'=>'logout']);
	});

	Route::any('/',['uses'=>'HomeController@index', 'as'=>'home']);
	Route::get('about-us',['uses'=>'HomeController@about', 'as'=>'about']);
	Route::get('contact-us',['uses'=>'HomeController@contact', 'as'=>'contact']);
	Route::post('contact-us',['uses'=>'HomeController@postcontact', 'as'=>'postcontact']);
});

Route::group(['name'=>'backend','namespace'=>'Backend','prefix' => 'backtoend'], function() {
	Route::group(['middleware' => 'guest:admin'], function() {
		Route::get('login',['uses'=>'AdminController@login', 'as'=>'admin.login']);
		Route::post('login',['uses'=>'AdminController@authlogin', 'as'=>'admin.authlogin']);
	});
	Route::group(['middleware' => 'auth:admin'], function() {
		Route::get('dashboard',['uses'=>'AdminController@index', 'as'=>'admin.dashboard']);
		Route::get('logout',['uses'=>'AdminController@logout', 'as'=>'admin.logout']);
		MyRoute::controller('cms', 'CmsController', 'App\Http\Controllers\Backend');
		Route::resource('categories','CategoryController',[ 'except'=> ['show'] ] );
		Route::get('categories/status/{id}',['uses'=>'CategoryController@status', 'as'=>'categories.status']);
		Route::resource('products','ProductController',[ 'except'=> ['show','create','store','update'] ] );
		Route::post('products/update_product/{id}',['uses'=>'ProductController@update_product', 'as'=>'products.update_product']);
		Route::get('products/status/{id}',['uses'=>'ProductController@status', 'as'=>'products.status']);
		Route::get('products/delete_image/{id}/{image_id}',['uses'=>'ProductController@delete_image', 'as'=>'products.delete_image']);
	});
});