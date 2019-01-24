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
    Route::get('dashboard', 'DashboardController@getDashboard')
        ->name('dashboard');

    Route::group(['prefix' => 'transactions'], function () {
        Route::get('add', 'TransactionController@getAdd')
            ->name('transactions.add');
        Route::post('add', 'TransactionController@postAdd');
        Route::delete('delete', 'TransactionController@delete')
            ->name('transactions.delete');
        Route::get('titles', 'TransactionController@getTitles')
            ->name('transactions.titles');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('profile', 'UsersController@getProfile')
            ->name('users.profile');
        Route::post('profile', 'UsersController@postProfile');
        Route::get('sign-out', 'UsersController@getSignOut')
            ->name('users.sign-out');
    });
});
