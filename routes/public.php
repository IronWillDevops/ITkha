<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use Illuminate\Auth\Events\Verified;

// Redirect from root to /posts
Route::redirect('/', '/posts');


Route::middleware('guest')->group(function () {
    Route::get('/login', App\Http\Controllers\Public\Auth\Login\IndexController::class)->name('login');
    Route::post('/login', App\Http\Controllers\Public\Auth\Login\StoreController::class)->name('login.store');
});


Route::get('/email/verify/{id}/{hash}', App\Http\Controllers\Public\Auth\Verify\VerifyEmailController::class)
    ->middleware(['signed'])
    ->name('verification.verify');


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

        //Скидання паролю 
        Route::prefix('/reset-password')
            ->name('resetpassword.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Auth\ResetPassword\IndexController::class)->name('index');
            });
    });

Route::post('logout', App\Http\Controllers\Admin\Auth\DeleteController::class)
    ->middleware('auth')
    ->name('logout');


Route::prefix('/')
    ->name('public.')
    ->group(function () {

        Route::prefix('/posts')
            ->name('post.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Public\Post\IndexController::class)->name('index');
                Route::get('/{post}', App\Http\Controllers\Public\Post\ShowController::class)->name('show');

                // Like Post
                // /Unlike post — only for authenticated users (can be restricted to admins)

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
