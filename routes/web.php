<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignOutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\ProfileController;

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {
    Route::get('/sign-in', [SignInController::class, 'show'])
        ->name('auth.sign-in.show');
    Route::post('/sign-in', [SignInController::class, 'do'])
        ->name('auth.sign-in.do');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'show'])
        ->name('home');

    Route::get('/auth/sign-out', [SignOutController::class, 'do'])
        ->name('auth.sign-out.do');

    Route::group(['prefix' => '/transactions'], function () {
        Route::get('/', [TransactionsController::class, 'index'])
            ->name('transactions.index');
        Route::get('/create', [TransactionsController::class, 'create'])
            ->name('transactions.create');
        Route::post('/', [TransactionsController::class, 'store'])
            ->name('transactions.store');
        Route::delete('/', [TransactionsController::class, 'delete'])
            ->name('transactions.delete');
        Route::get('/titles', [TransactionsController::class, 'titles'])
            ->name('transactions.titles');
    });

    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', [ProfileController::class, 'show'])
            ->name('profile.show');
        Route::post('/', [ProfileController::class, 'update'])
            ->name('profile.update');
    });
});
