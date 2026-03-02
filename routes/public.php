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

        Route::prefix('/cookie')
            ->name('cookie.')
            ->group(function () {

                Route::get('/', App\Http\Controllers\Public\Cookie\IndexController::class)->name('banner');
                Route::post('/accept', App\Http\Controllers\Public\Cookie\StoreController::class)->name('accept');
                Route::post('/revoke', App\Http\Controllers\Public\Cookie\DeleteController::class)->name('revoke');
            });

        Route::prefix('/user')
            ->name('user.')
            ->group(function () {
                Route::get('/{user}', App\Http\Controllers\Public\User\ShowController::class)->name('show');
                // // Пости користувача

                Route::get('/{user}/liked', App\Http\Controllers\Public\User\LikedController::class)->middleware('owner')->name('show.liked');
                Route::get('/{user}/favorites', App\Http\Controllers\Public\User\FavoritesController::class)->middleware('owner')->name('show.favorites');

                Route::prefix('/{user}/settings')
                    ->name('settings.')
                    ->middleware('owner')
                    ->group(function () {

                        Route::prefix('/personal')
                            ->name('personal.')
                            ->group(function () {
                                Route::get('/',  App\Http\Controllers\Public\User\Settings\Personal\IndexController::class)->name('index');
                                Route::patch('/',  App\Http\Controllers\Public\User\Settings\Personal\UpdateController::class)->name('update');
                            });
                        Route::prefix('/security')
                            ->name('security.')
                            ->group(function () {
                                Route::get('/',  App\Http\Controllers\Public\User\Settings\Security\IndexController::class)->name('index');
                                Route::patch('/',  App\Http\Controllers\Public\User\Settings\Security\UpdateController::class)->name('update');
                            });

                        Route::prefix('/session')
                            ->name('session.')
                            ->group(function () {
                                Route::get('/',  App\Http\Controllers\Public\User\Settings\Session\IndexController::class)->name('index');
                                Route::delete('/{session}',  App\Http\Controllers\Public\User\Settings\Session\DeleteController::class)->name('delete');
                            });
                    });
            });

        Route::name('sitemap.')
            ->group(function () {
                Route::get('/sitemap.xml', App\Http\Controllers\Public\Sitemap\IndexController::class)
                    ->name('index');

                Route::get('/sitemap/{type}-{page}.xml', App\Http\Controllers\Public\Sitemap\SectionController::class)
                    ->where(['type' => 'posts|users', 'page' => '[0-9]+'])
                    ->name('section');

                Route::get('/sitemap/pages.xml', App\Http\Controllers\Public\Sitemap\PagesController::class)
                    ->name('pages');
            });
    });
// public
Route::get('/policy', App\Http\Controllers\Public\Policy\ShowController::class)->name('policy.show');
Route::post('/policy/accept', App\Http\Controllers\Public\Policy\AcceptController::class)
    ->middleware('auth')
    ->name('policy.accept');
