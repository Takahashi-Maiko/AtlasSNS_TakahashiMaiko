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

Route::get('/logout','Auth\LoginController@logout');   //ログアウト機能 @logout→→@loginへ変更

Route::get('/search','UsersController@search')->name('users.search')->middleware('auth') ;   //ユーザー検索

Route::get('/follow-list','PostsController@index')->middleware('auth') ;   //フォローリスト
Route::get('/follower-list','PostsController@index')->middleware('auth') ;   //フォロワーリスト

//↓↓フォローとフォロー解除機能の追加
Route::post('/users/{id}/follow','FollowsController@follow')->name('follow');   //フォローする
Route::post('/users/{id}/unfollow','FollowsController@unfollow')->name('unfollow');   //フォロー解除する

//投稿機能の追加
Route::get('/top','PostsController@index')->middleware('auth') ;
Route::post('/top','PostsController@post')->name('post');   //投稿の登録機能

// ログイン後
Route::post('/update','UsersController@profile');
