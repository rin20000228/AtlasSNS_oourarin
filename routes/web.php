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
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');


//↓ミドルウェア：ログイン認証を行い、ログイン認証していないと見れないページを設定する
Route::group(['middleware' => 'auth'], function () {
  //ログイン中のページ
  Route::get('/top', 'PostsController@index');

  //ユーザー検索
  Route::get('/search', 'UsersController@search');
  Route::get('/follow-list', 'PostsController@index');

  Route::get('/follower-list', 'PostsController@index');

  //トップページ
  Route::get('/top', 'PostsController@index');
  //新規投稿の登録
  Route::post('/post/create', 'PostsController@create');
  //投稿の編集
  Route::post('/post/update', 'PostsController@update');
  //投稿の削除
  Route::get('/post/{id}/delete', 'PostsController@delete');

  //検索ページ
  Route::get('/search', 'UsersController@search');
  //フォローする
  Route::get('/user/{id}/follow', 'UsersController@follow')->name('follow');
  //フォロー解除
  Route::get('/user/{id}/unfollow', 'UsersController@unfollow')->name('unfollow');

  //フォローリスト
  Route::get('/follow-list', 'FollowsController@followList');

  //フォロワーリスト
  Route::get('/follower-list', 'FollowsController@followerList');

  //プロフィール
  Route::get('/profile', 'UsersController@profile');
  //プロフィールの更新
  Route::post('/profile/update', 'UsersController@profileUpdate');

  //相手ユーザーのプロフィール
  Route::get('/users/{id}/profile', 'UsersController@otherProfile');


  //↓ログアウトのメソッド
  Route::get('logout', 'Auth\LoginController@logout');
  Route::post('logout', 'Auth\LoginController@logout');
});
