<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('email/verify/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');

    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

    Route::get('user', 'Auth\AuthenticationController@user')->name('user');

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::post('add-post', 'PostController@store')->name('post.store');

    Route::get('posts', 'PostController@index')->name('posts');

    Route::get('post/{id}', 'PostController@show')->name('edit.post');

    Route::post('update-post/{id}', 'PostController@update')->name('update.post');

    Route::post('delete-post/{id}', 'PostController@destroy')->name('post.destroy');

    Route::post('add-comment', 'CommentController@store')->name('comment.store');

    Route::get('comment/{id}', 'CommentController@show')->name('edit.comment');

    Route::post('update-comment/{id}', 'CommentController@update')->name('update.comment');

    Route::post('delete-comment/{id}', 'CommentController@destroy')->name('comment.destroy');


});
