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

// ログアウト中のページ -------------------------------
Route::get('/login', 'Auth\Login\LoginController@login')->name('login');
Route::post('/login', 'Auth\Login\LoginController@login');

Route::get('/register', 'Auth\Register\RegisterAddedController@register');
Route::post('/register', 'Auth\Register\RegisterAddedController@createnewuser');

// ログイン中のページ -------------------------------
Route::group(['middleware' => ['auth']], function () { //loginしていなければlogin画面に返すようにする
  Route::get('/home/{keyword?}', 'User\Post\PostsController@show')->name('post.show');
  //コメントへのいいね機能
  // Route::post('/home', 'User\Post\PostCommentFavoritesController@favorite');
  // Route::post('/home', 'User\Post\PostCommentFavoritesController@favorite');

  //投稿ページ
  //投稿ページを表示
  Route::get('/post_create', 'User\Post\PostsController@open')->name('post.create');
  //投稿する
  Route::post('/post_create', 'User\Post\PostsController@create');
  //投稿詳細ページ
  Route::get('/post_detail/{id}', 'User\Post\PostsController@postDetail')->name('post.detail');
  //投稿編集ページ
  Route::get('/post_edit', 'User\Post\PostsController@postEdit')->name('post.edit');
  Route::post('/post_edit', 'User\Post\PostsController@edit');
  //投稿削除機能
  Route::post('/post_edit', 'User\Post\PostsController@delete');

  //コメント機能
  Route::post('/post_detail', 'User\Post\PostCommentsController@commentCreate')->name('comment.create');
  //コメント編集ページ
  Route::get('/comment_edit', 'User\Post\PostCommentsController@commentEdit')->name('comment.edit');
  //コメント編集機能
  Route::post('/comment_edit', 'User\Post\PostCommentsController@edit');
  //コメント削除機能
  Route::post('/comment_edit', 'User\Post\PostCommentsController@delete');
  //コメントへのいいね機能
  Route::post('/post_detail', 'User\Post\PostCommentFavoritesController@favorite');
  Route::post('/post_detail', 'User\Post\PostCommentFavoritesController@favorite');
});
