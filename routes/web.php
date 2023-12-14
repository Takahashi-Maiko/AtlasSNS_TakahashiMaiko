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
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');   //未認証のユーザーをログイン画面へ飛ばすために->name('login')を記述する。
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@registerView');
Route::post('/register', 'Auth\RegisterController@register');


Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index')->middleware('auth') ;   //トップページへ

Route::get('/profile','UsersController@profile')->middleware('auth') ;   //プロフィール編集ページへ

Route::get('/logout','Auth\LoginController@login');   //ログアウト機能 @logout→→@loginへ変更

Route::get('/search','UsersController@index')->middleware('auth') ;   //ユーザー検索

Route::get('/follow-list','PostsController@index')->middleware('auth') ;   //フォローリスト
Route::get('/follower-list','PostsController@index')->middleware('auth') ;   //フォロワーリスト

// ログイン後
Route::post('/top','UsersController@profile');
