<?php
// use App\Mail\WelcomeEmail;

/*Route::get('/', function () {
	$user = \App\User::all();
	return view('welcome',compact('user'));
});*/
Route::get('/', "WelcomeController@index");

// Middleware 'can:isAdmin' only access admin only
// 'can:isAllowed,"Admin:Subscribers"'

Route::prefix('admin')->middleware(['auth','check.role:Admin'])->group(function(){
//Route::prefix('admin')->middleware(['auth'])->group(function(){
	Route::view('/',"dashboard.admin");
	Route::resource('posts', "PostController");
	Route::resource('pages', "PageController");
	Route::resource('profiles', "ProfileController");
	Route::resource('users', "UserController");
	Route::resource('categories', "CategoryController");
	Route::resource('roles', "RoleController");
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::match(['get','post'], '/home', 'HomeController@index')->name('home');
//Route::match(['get','post'],'');

// call to mail function
/*Route::get('email',function(){
	return new WelcomeEmail();
});*/