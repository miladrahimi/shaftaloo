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
Route::get('/auth/sign-in', 'AuthController@getSignIn')->name('auth.sign-in');
Route::post('/auth/sign-in', 'AuthController@postSignIn');
Route::get('/auth/sign-out', 'AuthController@getSignOut')->name('auth.sign-out');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/transactions', 'TransactionController@getTransactions')
        ->name('transactions');
    Route::post('/transactions', 'TransactionController@postTransaction');
    Route::get('/transactions/add', 'TransactionController@getAdd')
        ->name('transactions.add');
    Route::post('/transactions/add', 'TransactionController@postAdd');
    Route::delete('/transactions', 'TransactionController@deleteTransaction');
    Route::get('/transactions/archive', 'TransactionController@getArchive')
        ->name('transactions.archive');

    Route::get('/users/profile', 'UsersController@getProfile')
        ->name('users.profile');
    Route::post('/users/profile', 'UsersController@postProfile');
});
