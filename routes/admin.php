<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/login-redirect', fn () => redirect()->route('admin.login.index'))
    ->name('login');

// Auth routes
Route::middleware('guest')->group(function () {
 
    Route::get('/login', App\Http\Controllers\Admin\Auth\IndexController::class)->name('admin.login.index');
    Route::post('/login', App\Http\Controllers\Admin\Auth\StoreController::class)->middleware('throttle:login')->name('admin.login.store');
});

// Logout
Route::post('admin/logout', App\Http\Controllers\Admin\Auth\DeleteController::class)
    ->middleware('auth')
    ->name('admin.logout');




Route::name('admin.')
    ->middleware(['auth',\App\Http\Middleware\CheckUserVerifiedAndStatus::class, App\Http\Middleware\AdminMiddleware::class])
    ->group(function () {

        Route::get('/dashboard', App\Http\Controllers\Admin\IndexController::class)->name('index');

        Route::prefix('icons')
            ->name('icons.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Icons\IndexController::class)->name('index');
            });
        Route::prefix('categories')
            ->name('category.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Category\IndexController::class)->name('index')->middleware('permission:categories_show');
                Route::get('/create', App\Http\Controllers\Admin\Category\CreateController::class)->name('create')->middleware('permission:categories_create');
                Route::post('/store', App\Http\Controllers\Admin\Category\StoreController::class)->name('store')->middleware('permission:categories_create');
                Route::get('/{category}', App\Http\Controllers\Admin\Category\ShowController::class)->name('show')->middleware('permission:categories_show');
                Route::get('/{category}/edit', App\Http\Controllers\Admin\Category\EditController::class)->name('edit')->middleware('permission:categories_edit');
                Route::patch('/{category}', App\Http\Controllers\Admin\Category\UpdateController::class)->name('update')->middleware('permission:categories_edit');
                Route::delete('/{category}', App\Http\Controllers\Admin\Category\DeleteController::class)->name('delete')->middleware('permission:categories_delete');
            });
        Route::prefix('tags')
            ->name('tag.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Tag\IndexController::class)->name('index')->middleware('permission:tags_show');
                Route::get('/create', App\Http\Controllers\Admin\Tag\CreateController::class)->name('create')->middleware('permission:tags_create');
                Route::post('/store', App\Http\Controllers\Admin\Tag\StoreController::class)->name('store')->middleware('permission:tags_create');
                Route::get('/{tag}', App\Http\Controllers\Admin\Tag\ShowController::class)->name('show')->middleware('permission:tags_show');
                Route::get('/{tag}/edit', App\Http\Controllers\Admin\Tag\EditController::class)->name('edit')->middleware('permission:tags_edit');
                Route::patch('/{tag}', App\Http\Controllers\Admin\Tag\UpdateController::class)->name('update')->middleware('permission:tags_edit');
                Route::delete('/{tag}', App\Http\Controllers\Admin\Tag\DeleteController::class)->name('delete')->middleware('permission:tags_delete');
            });

        Route::prefix('posts')
            ->name('post.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Post\IndexController::class)->name('index')->middleware('permission:posts_show');
                Route::get('/create', App\Http\Controllers\Admin\Post\CreateController::class)->name('create')->middleware('permission:posts_create'); // 
                Route::post('/store', App\Http\Controllers\Admin\Post\StoreController::class)->name('store')->middleware('permission:posts_create');
                Route::get('/{post}', App\Http\Controllers\Admin\Post\ShowController::class)->name('show')->middleware('permission:posts_show');
                Route::get('/{post}/edit', App\Http\Controllers\Admin\Post\EditController::class)->name('edit')->middleware('permission:posts_edit');
                Route::patch('/{post}', App\Http\Controllers\Admin\Post\UpdateController::class)->name('update')->middleware('permission:posts_edit');
                Route::delete('/{post}', App\Http\Controllers\Admin\Post\DeleteController::class)->name('delete')->middleware('permission:posts_delete');
            });
        Route::prefix('users')
            ->name('user.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\User\IndexController::class)->name('index')->middleware('permission:users_show');
                Route::get('/create', App\Http\Controllers\Admin\User\CreateController::class)->name('create')->middleware('permission:users_create');
                Route::post('/store', App\Http\Controllers\Admin\User\StoreController::class)->name('store')->middleware('permission:users_create');
                Route::get('/{user}', App\Http\Controllers\Admin\User\ShowController::class)->name('show')->middleware('permission:users_show');
                Route::get('/{user}/edit', App\Http\Controllers\Admin\User\EditController::class)->name('edit')->middleware('permission:users_edit');
                Route::patch('/{user}', App\Http\Controllers\Admin\User\UpdateController::class)->name('update')->middleware('permission:users_edit');
                Route::delete('/{user}', App\Http\Controllers\Admin\User\DeleteController::class)->name('delete')->middleware('permission:users_delete');
            });

        Route::prefix('roles')
            ->name('role.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Role\IndexController::class)->name('index')->middleware('permission:roles_show');
                Route::get('/create', App\Http\Controllers\Admin\Role\CreateController::class)->name('create')->middleware('permission:roles_create');
                Route::post('/store', App\Http\Controllers\Admin\Role\StoreController::class)->name('store')->middleware('permission:roles_create');
                Route::get('/{role}', App\Http\Controllers\Admin\Role\ShowController::class)->name('show')->middleware('permission:roles_show');
                Route::get('/{role}/edit', App\Http\Controllers\Admin\Role\EditController::class)->name('edit')->middleware('permission:roles_edit');
                Route::patch('/{role}', App\Http\Controllers\Admin\Role\UpdateController::class)->name('update')->middleware('permission:roles_edit');
                Route::delete('/{role}', App\Http\Controllers\Admin\Role\DeleteController::class)->name('delete')->middleware('permission:roles_delete');
            });

        Route::prefix('contact')
            ->name('contact.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Contact\IndexController::class)->name('index')->middleware('permission:contacts_show');
                Route::get('/{contact}', App\Http\Controllers\Admin\Contact\ShowController::class)->name('show')->middleware('permission:contacts_show');
                Route::patch('/{contact}/mark-read', App\Http\Controllers\Admin\Contact\UpdateController::class)->name('update')->middleware('permission:contacts_edit');
                Route::delete('/delete', App\Http\Controllers\Admin\Contact\DeleteController::class)->name('delete')->middleware('permission:contacts_delete');
            });
        Route::prefix('log')
            ->name('log.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Log\IndexController::class)->name('index')->middleware('permission:logs_show');
            });
        Route::prefix('settings')
            ->name('settings.')
            ->group(function () {
                Route::prefix('social-link')
                    ->name('social.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\SocialLink\IndexController::class)->name('index');
                        Route::get('/create', App\Http\Controllers\Admin\SocialLink\CreateController::class)->name('create');
                        Route::post('/store', App\Http\Controllers\Admin\SocialLink\StoreController::class)->name('store');
                        Route::get('/{link}', App\Http\Controllers\Admin\SocialLink\ShowController::class)->name('show');
                        Route::get('/{link}/edit', App\Http\Controllers\Admin\SocialLink\EditController::class)->name('edit');
                        Route::patch('/{link}', App\Http\Controllers\Admin\SocialLink\UpdateController::class)->name('update');
                        Route::delete('/{link}', App\Http\Controllers\Admin\SocialLink\DeleteController::class)->name('delete');
                    });
            });
    });
