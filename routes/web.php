<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/sign-in', [SignInController::class, 'show'])
        ->name('auth.sign-in.show');
    Route::post('/auth/sign-in', [SignInController::class, 'do'])
        ->name('auth.sign-in.do');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'show'])
        ->name('dashboard');

    Route::group(['prefix' => '/transactions'], function () {
        Route::get('/create', [TransactionController::class, 'create'])
            ->name('transactions.create');
        Route::post('/', [TransactionController::class, 'store'])
            ->name('transactions.store');
        Route::delete('/', [TransactionController::class, 'delete'])
            ->name('transactions.delete');
        Route::get('/titles', [TransactionController::class, 'titles'])
            ->name('transactions.titles');
    });

    Route::group(['prefix' => '/users'], function () {
        Route::get('profile', [UsersController::class, 'showProfile'])
            ->name('users.profile.show');
        Route::post('profile', [UsersController::class, 'updateProfile'])
            ->name('users.profile.update');
        Route::get('sign-out', [UsersController::class, 'doSignOut'])
            ->name('users.sign-out');
    });
});
