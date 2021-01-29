<?php

use App\Http\Controllers\Auth\SignInController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/sign-in', [SignInController::class, 'show'])
        ->name('auth.sign-in.show');
    Route::post('/auth/sign-in', [SignInController::class, 'do'])
        ->name('auth.sign-in.do');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@getDashboard')
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
