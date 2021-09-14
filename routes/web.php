<?php

use Illuminate\Support\Facades\Route;

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
//Public
Route::get('/', 'App\Http\Controllers\PublicPagesController@index')->name('public.home');
Route::get('/about-me', 'App\Http\Controllers\PublicPagesController@about')->name('public.about');
Route::get('/blog/{slug?}', 'App\Http\Controllers\PublicPagesController@blog')->name('public.blog');
Route::get('/blog-scroll/{category?}', 'App\Http\Controllers\PublicPagesController@blogPagination')->name('public.blog.scroll');
Route::get('/filter-category/{category?}', 'App\Http\Controllers\PublicPagesController@filter')->name('public.filter.category');
Route::get('/article/{id}', 'App\Http\Controllers\PublicPagesController@article')->name('public.article');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
	\UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);


	//Users

	Route::get('create-user', 'App\Http\Controllers\UserController@create')->name('create.user');
	Route::post('store-user', 'App\Http\Controllers\UserController@store')->name('store.user');
	Route::get('edit-user/{id}', 'App\Http\Controllers\UserController@edit')->name('edit.user');
	Route::patch('update-user', 'App\Http\Controllers\UserController@update')->name('update.user');
	Route::patch('update-profile-image', 'App\Http\Controllers\UserController@updateProfileImage')->name('update.profile.image.user');
	Route::post('delete-user', 'App\Http\Controllers\UserController@destroy')->name('delete.user');
	Route::patch('show-user', 'App\Http\Controllers\UserController@show')->name('show.user');

	//Users Experience

	Route::get('user-experience/{id}', 'App\Http\Controllers\UserExperienceController@index')->name('user.experience');
	Route::get('add-user-experience/{id}', 'App\Http\Controllers\UserExperienceController@create')->name('add.user.experience');
	Route::post('store-user-experience', 'App\Http\Controllers\UserExperienceController@store')->name('store.user.experience');
	Route::get('edit-user-experience/{user}/{id}', 'App\Http\Controllers\UserExperienceController@edit')->name('edit.user.experience');
	Route::patch('update-user-experience', 'App\Http\Controllers\UserExperienceController@update')->name('update.user.experience');
	Route::post('delete-experience',  'App\Http\Controllers\UserExperienceController@destroy')->name('delete.user.experience');
	
	
	//Media

	Route::get('media-images', 'App\Http\Controllers\MediaController@images')->name('media.images');
	Route::get('media-files', 'App\Http\Controllers\MediaController@files')->name('media.files');

	//Tasks
	Route::get('list-task', 'App\Http\Controllers\TaskController@list')->name('index.task');
	Route::get('create-task', 'App\Http\Controllers\TaskController@create')->name('create.task');
	Route::post('store-task', 'App\Http\Controllers\TaskController@store')->name('store.task');
	Route::get('edit-task/{id}', 'App\Http\Controllers\TaskController@edit')->name('edit.task');
	Route::patch('update-task', 'App\Http\Controllers\TaskController@update')->name('update.task');
	Route::post('delete-task', 'App\Http\Controllers\TaskController@destroy')->name('delete.task');
	Route::patch('complete-task/{id}',  'App\Http\Controllers\TaskController@complete')->name('complete.task');


	//Categories
	Route::get('list-category', 'App\Http\Controllers\CategoryController@list')->name('index.category');
	Route::get('create-category', 'App\Http\Controllers\CategoryController@create')->name('create.category');
	Route::post('store-category', 'App\Http\Controllers\CategoryController@store')->name('store.category');
	Route::get('edit-category/{id}', 'App\Http\Controllers\CategoryController@edit')->name('edit.category');
	Route::patch('update-category', 'App\Http\Controllers\CategoryController@update')->name('update.category');
	Route::post('delete-category', 'App\Http\Controllers\CategoryController@destroy')->name('delete.category');

	//Posts 

	Route::get('list-post', 'App\Http\Controllers\PostController@list')->name('index.post');
	Route::get('create-post', 'App\Http\Controllers\PostController@create')->name('create.post');
	Route::post('store-post', 'App\Http\Controllers\PostController@store')->name('store.post');
	Route::get('edit-post/{id}', 'App\Http\Controllers\PostController@edit')->name('edit.post');
	Route::patch('update-post', 'App\Http\Controllers\PostController@update')->name('update.post');
	Route::post('delete-post' , 'App\Http\Controllers\PostController@destroy')->name('delete.post');

	//Settings 

	//General Settings

	Route::get('index-general-settings', 'App\Http\Controllers\SettingsController@indexGeneral')->name('index.general.settings');
	Route::patch('update-general-settings', 'App\Http\Controllers\SettingsController@updateGeneral')->name('update.general.settings');

	//Social Settings

	Route::get('index-social-settings', 'App\Http\Controllers\SettingsController@indexSocial')->name('index.social.settings');
	Route::patch('update-social-settings', 'App\Http\Controllers\SettingsController@updateSocial')->name('update.social.settings');


	//Statistics 

	Route::get('index-dashboard', 'App\Http\Controllers\StatisticsController@index')->name('update.index.dashboard');

});

