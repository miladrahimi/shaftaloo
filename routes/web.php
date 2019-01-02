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

Route::get('/', 'HomeController@getHome');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/sign-in', 'AuthController@getSignIn')
        ->name('auth.sign-in');
    Route::post('/auth/sign-in', 'AuthController@postSignIn');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('index', 'TransactionController@getIndex')
            ->name('transactions.index');
        Route::get('add', 'TransactionController@getAdd')
            ->name('transactions.add');
        Route::post('add', 'TransactionController@postAdd');
        Route::delete('delete', 'TransactionController@delete')
            ->name('transactions.delete');
    });

    Route::group(['prefix' => 'archives'], function () {
        Route::get('index', 'ArchivesController@getIndex')
            ->name('archives.index');
        Route::get('perform', 'ArchivesController@getPerform')
            ->name('archives.perform');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('profile', 'UsersController@getProfile')
            ->name('users.profile');
        Route::post('profile', 'UsersController@postProfile');
        Route::get('sign-out', 'UsersController@getSignOut')
            ->name('users.sign-out');
    });
});
