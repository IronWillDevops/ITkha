<?php

use Illuminate\Support\Facades\Route;
// Redirect from root to /post
Route::redirect('/', '/post');

Route::middleware('guest')->group(function () {
    Route::get('/login', App\Http\Controllers\Public\Auth\Login\IndexController::class)->name('login');
    Route::post('/login', App\Http\Controllers\Public\Auth\Login\StoreController::class)->middleware('throttle:login')
        ->name('login.store');
});
Route::post('logout', App\Http\Controllers\Admin\Auth\DeleteController::class)
    ->middleware('auth')
    ->name('logout');


Route::get('/email/verify/{id}/{hash}', App\Http\Controllers\Public\Auth\Verify\VerifyEmailController::class)
    ->middleware(['signed'])
    ->name('verification.verify');
Route::get('/captcha', App\Http\Controllers\Public\Auth\Captcha\CaptchaController::class)->name('captcha.generate');

Route::get('/locale/{locale}', App\Http\Controllers\Public\Language\LocaleController::class)
    ->name('locale.switch');


Route::prefix('/auth')
    ->name('public.auth.')
    ->middleware('guest')
    ->group(function () {

        //  Реєстрація
        Route::prefix('/register')
            ->name('register.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Auth\Register\IndexController::class)->name('index');
                Route::post('/store', App\Http\Controllers\Public\Auth\Register\StoreController::class)->name('store');
            });

        // re-verification
        Route::prefix('/reverification')
            ->name('reverification.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Auth\ReVerification\IndexController::class)->name('index');
                Route::post('/store', App\Http\Controllers\Public\Auth\ReVerification\StoreController::class)->name('store');
            });
        Route::prefix('/forgot-password')
            ->name('forgot.password.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Auth\ForgotPassword\IndexController::class)->name('index');
                Route::post('/store', App\Http\Controllers\Public\Auth\ForgotPassword\StoreController::class)->name('store');
            });
        Route::prefix('/reset-password')
            ->name('reset.password.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Auth\ResetPassword\IndexController::class)->name('index');
                Route::post('/store', App\Http\Controllers\Public\Auth\ResetPassword\StoreController::class)->name('store');
            });
    });



Route::prefix('/')
    ->name('public.')
    ->group(function () {
        Route::prefix('/post')
            ->name('post.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Post\IndexController::class)->name('index');
                Route::get('/{post}', App\Http\Controllers\Public\Post\ShowController::class)->name('show');

                Route::middleware('auth')->group(function () {
                    Route::post('/comments', App\Http\Controllers\Public\Comment\StoreController::class)
                        ->name('comment.store');
                });
            });

        Route::prefix('/pages')
            ->name('pages.')
            ->group(function () {
                Route::prefix('/contact')
                    ->name('contact.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Public\Page\Contact\IndexController::class)->name('index');
                        Route::post('/store', App\Http\Controllers\Public\Page\Contact\StoreController::class)->name('store');
                    });


            });

        Route::prefix('/user')
            ->name('user.')
            ->group(function () {
                Route::get('/{user}', App\Http\Controllers\Public\User\ShowController::class)->name('show');
                Route::get('/{user}/liked', App\Http\Controllers\Public\User\LikedPostsController::class)->name('show.like');
                Route::get('/{user}/favorite', App\Http\Controllers\Public\User\FavoritePostsController::class)->name('show.favorite');
                Route::get('/{user}/edit', App\Http\Controllers\Public\User\EditController::class)->middleware('auth')->name('edit');
                Route::patch('/{user}', App\Http\Controllers\Public\User\UpdateController::class)->middleware('auth')->name('update');
                Route::patch('/{user}/password', App\Http\Controllers\Public\User\UpdatePasswordController::class)->middleware('auth')->name('password.update');
            });
    });
