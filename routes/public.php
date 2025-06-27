<?php

use Illuminate\Support\Facades\Route;

 Route::redirect('/', '/posts');

Route::prefix('/')
    ->name('public.')
    ->group(function () {
        // Редирект з кореня на /posts
        Route::prefix('/auth')
            ->name('auth.')
            ->middleware('guest')
            ->group(function () {
                Route::prefix('/login')
                    ->name('login.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Public\Auth\Login\IndexController::class)->name('index');
                        Route::post('/store', App\Http\Controllers\Public\Auth\Login\StoreController::class)->name('store');
                    });

                Route::prefix('/register')
                    ->name('register.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Public\Auth\Register\IndexController::class)->name('index');
                        Route::post('/store', App\Http\Controllers\Public\Auth\Register\StoreController::class)->name('store');
                    });
                Route::prefix('/reset-password')
                    ->name('resetpassword.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Public\Auth\ResetPassword\IndexController::class)->name('index');
                    });
            });

        Route::post('logout', App\Http\Controllers\Admin\Auth\DeleteController::class)
            ->middleware('auth')
            ->name('logout');


        Route::prefix('/posts')
            ->name('post.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Post\IndexController::class)->name('index');
                Route::get('/{post}', App\Http\Controllers\Public\Post\ShowController::class)->name('show');

                // Лайк поста
                // Лайк/анлайк поста — только для авторизованных пользователей (можно с ограничением на админов)
                Route::middleware(['auth', 'verified'])->group(function () {
                    Route::post('/{post}/like', App\Http\Controllers\Public\Post\LikeController::class)->name('like');
                });
            });


        Route::prefix('pages/contact')
            ->name('pages.contact.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Page\Contact\IndexController::class)->name('index');
                Route::post('/store', App\Http\Controllers\Public\Page\Contact\StoreController::class)->name('store');
            });


        Route::prefix('/users')
            ->name('user.')
            ->group(function () {
                Route::get('/{user}', App\Http\Controllers\Public\User\ShowController::class)->name('show');
            });
    });

