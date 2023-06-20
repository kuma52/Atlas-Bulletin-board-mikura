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
Route::namespace('Auth')->group(function () {
  Route::get('/login', 'Login\LoginController@login')->name('login');
  Route::post('/login', 'Login\LoginController@login');

  Route::get('/register', 'Register\RegisterAddedController@register');
  Route::post('/register', 'Register\RegisterAddedController@createnewuser');
});

// ログイン中のページ -------------------------------

Route::group(['middleware' => ['auth']], function () { //loginしていなければlogin画面に返すようにする
  Route::namespace('User\Post')->group(function () {
    Route::get('/home/{keyword?}', 'PostsController@show')->name('post.show');
    Route::post('/home/{keyword?}', 'PostsController@show')->name('post.show');

    //投稿ページ
    Route::get('/post_create', 'PostsController@open')->name('post.create');
    Route::post('/post_create', 'PostsController@create');
    //投稿詳細ページ
    Route::get('/post_detail/{id}', 'PostsController@postDetail')->name('post.detail');
    //いいね
    Route::post('/favorite/post/{id}', 'PostFavoritesController@postFavorite');
    Route::post('/favorite/post/{id}', 'PostFavoritesController@postUnFavorite');
    //投稿編集ページ
    Route::post('/post_edit', 'PostsController@postEdit')->name('post.edit');
    Route::post('/post_edit', 'PostsController@edit');
    //投稿削除機能
    Route::post('/post_edit', 'PostsController@delete');

    //コメント機能
    Route::post('/post_detail', 'PostCommentsController@commentCreate')->name('comment.create');
    //コメント編集ページ
    Route::get('/comment_edit', 'PostCommentsController@commentEdit')->name('comment.edit');
    //コメント編集機能
    Route::post('/comment_edit', 'PostCommentsController@edit');
    //コメント削除機能
    Route::post('/comment_edit', 'PostCommentsController@delete');
    //コメントへのいいね機能
    Route::post('/post_detail', 'PostCommentFavoritesController@favorite');
    Route::post('/post_detail', 'PostCommentFavoritesController@favorite');
  });
  //ログアウト（→ログイン画面へ遷移）
  Route::get('/logout', 'Auth\Login\LoginController@logout')->name('logout');
});
