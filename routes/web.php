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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/hello', function(){
//     return 'Hello World';
// });

if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

Route::resource('posts', 'PostsController');

Route::get('/posts/create/{id}', 'PostsController@create'); // override default create; get thread id

Route::resource('users', 'UsersController');

Route::resource('threads', 'ThreadsController');

Route::resource('comments', 'CommentsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
