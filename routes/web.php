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
    Route::post('/postfavorite/post/{id}', 'PostFavoritesController@postFavorite')->name('post.favorite');
    Route::post('/postunfavorite/post/{id}', 'PostFavoritesController@postUnFavorite')->name('post.unfavorite');
    //投稿編集ページ
    Route::get('/post_edit/{id}', 'PostsController@showEdit')->name('show.edit');
    Route::post('/post_edit/update/{id}', 'PostsController@postEdit')->name('post.edit');
    //投稿削除機能
    Route::post('/post_edit/delete/{id}', 'PostsController@postDelete')->name('post.delete');

    //コメント機能
    Route::post('/post_detail/{id}/comment', 'PostCommentsController@create')->name('comment.create');
    //コメント編集ページ
    Route::get('/comment_edit/{id}', 'PostCommentsController@showEdit')->name('show.comment.edit');
    //コメント編集機能
    Route::post('/comment_edit/{id}', 'PostCommentsController@edit')->name('comment.edit');
    //コメント削除機能
    Route::post('/comment_delete/{id}', 'PostCommentsController@delete')->name('comment.delete');
    //コメントへのいいね機能
    Route::post('/postcommentfavorite/post/{id}', 'PostCommentFavoritesController@commentFavorite');
    Route::post('/postcommentunfavorite/post/{id}', 'PostCommentFavoritesController@commentunFavorite');
  });
  //ログアウト（→ログイン画面へ遷移）
  Route::get('/logout', 'Auth\Login\LoginController@logout')->name('logout');
});
