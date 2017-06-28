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
Route::get('/', function () {
    return view('welcome');
});
//Auth::routes();

/*Route::group(['name' => 'frontend'], function() {
	Route::group(['middleware' => 'guest:web'], function() {
		Route::get('login',['uses'=>'UserController@login', 'as'=>'login']);
		Route::post('login',['uses'=>'UserController@authlogin', 'as'=>'userlogin']);
		Route::get('register',['uses'=>'UserController@register', 'as'=>'register']);
		Route::post('register',['uses'=>'UserController@authregister', 'as'=>'userregister']);
	});
	Route::group(['middleware' => 'auth'], function() {
		Route::any('logout',['uses'=>'UserController@logout', 'as'=>'logout']);
	});

	Route::any('/',['uses'=>'HomeController@index', 'as'=>'home']);
	Route::get('about-us',['uses'=>'HomeController@about', 'as'=>'about']);
	Route::get('contact-us',['uses'=>'HomeController@contact', 'as'=>'contact']);
	Route::post('contact-us',['uses'=>'HomeController@postcontact', 'as'=>'postcontact']);

	Route::get('custom-register',['uses'=>'HomeController@register', 'as'=>'cusregister']);
	Route::post('custom-register',['uses'=>'HomeController@postregister', 'as'=>'postcusregister']);
	Route::get('custom-form',['uses'=>'HomeController@cusform', 'as'=>'cusform']);
	Route::post('custom-form',['uses'=>'HomeController@postcusform', 'as'=>'postcusform']);
	Route::get('payment-form',['uses'=>'HomeController@payment_form', 'as'=>'payment_form']);
	Route::post('payment-form',['uses'=>'HomeController@postpayment_form', 'as'=>'postpayment_form']);

	Route::get('payment-test',['uses'=>'HomeController@getCheckout', 'as'=>'payment_test']);
	Route::get('payment-done',['uses'=>'HomeController@getDone', 'as'=>'payment_form']);
	Route::get('payment-fail',['uses'=>'HomeController@getCancel', 'as'=>'payment_form']);


	Route::get('blog','BlogController@index')->name('blog.index');
	Route::get('blog/{slug}','BlogController@single')->name('blog.single')->where('slug','[\w\d\-]+');
	Route::post('comments/{post_id}',['uses'=>'CommentsController@store', 'as'=>'comments.store']);

	Route::get('shop','ShopController@index')->name('shop.index');
	Route::get('shop/{sku}','ShopController@single')->name('shop.single')->where('sku','[\w\d\-]+');
	MyRoute::controller('cart', 'CartController', 'App\Http\Controllers');
});*/

Route::group(['name'=>'backend','namespace'=>'Backend','prefix' => 'backtoend'], function() {
	Route::group(['middleware' => 'guest:admin'], function() {
		//Route::get('/',['uses'=>'AdminController@login', 'as'=>'admin.login']);
		Route::get('login',['uses'=>'AdminController@login', 'as'=>'admin.login']);
		Route::post('login',['uses'=>'AdminController@authlogin', 'as'=>'admin.authlogin']);
	});
	Route::group(['middleware' => 'auth:admin'], function() {
		Route::get('dashboard',['uses'=>'AdminController@index', 'as'=>'admin.dashboard']);
		Route::get('logout',['uses'=>'AdminController@logout', 'as'=>'admin.logout']);
		MyRoute::controller('cms', 'CmsController', 'App\Http\Controllers\Backend');
		Route::resource('categories','CategoryController',[ 'except'=> ['show'] ] );
		Route::get('categories/status/{id}',['uses'=>'CategoryController@status', 'as'=>'categories.status']);
		/*
		MyRoute::controller('products','ProductController','App\Http\Controllers\Backend' );
		Route::resource('posts','PostsController');
		Route::resource('tags','TagController',[ 'except'=> ['create','show'] ] );
		Route::get('posts/comments/{id}',['uses'=>'PostsController@updateComment', 'as'=>'comments.update']);
		Route::delete('posts/comments/{id}/',['uses'=>'PostsController@destroyComment', 'as'=>'comments.destroy']);
		*/
	});
});