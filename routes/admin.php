<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')
    ->middleware(['auth', \App\Http\Middleware\CheckUserVerifiedAndStatus::class, App\Http\Middleware\AdminMiddleware::class])
    ->group(function () {
        Route::redirect('/', '/dashboard');
        Route::get('/dashboard', App\Http\Controllers\Admin\Dashboard\IndexController::class)->name('index');

        Route::prefix('posts')
            ->name('post.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Posts\Post\IndexController::class)->name('index')->middleware('permission:posts_show');
                Route::get('/create', App\Http\Controllers\Admin\Posts\Post\CreateController::class)->name('create')->middleware('permission:posts_create'); // 
                Route::post('/store', App\Http\Controllers\Admin\Posts\Post\StoreController::class)->name('store')->middleware('permission:posts_create');
                Route::post('/image-upload', App\Http\Controllers\Admin\Posts\Post\UploadImageController::class)->name('image.upload')->middleware('permission:posts_create');
                Route::post('/image-delete', App\Http\Controllers\Admin\Posts\Post\DeleteImageController::class)->name('image.delete')->middleware('permission:posts_edit');

                Route::get('/{post}', App\Http\Controllers\Admin\Posts\Post\ShowController::class)->name('show')->middleware('permission:posts_show');
                Route::get('/{post}/edit', App\Http\Controllers\Admin\Posts\Post\EditController::class)->name('edit')->middleware('permission:posts_edit');
                Route::patch('/{post}', App\Http\Controllers\Admin\Posts\Post\UpdateController::class)->name('update')->middleware('permission:posts_edit');
                Route::delete('/{post}', App\Http\Controllers\Admin\Posts\Post\DeleteController::class)->name('delete')->middleware('permission:posts_delete');
            });
        Route::prefix('categories')
            ->name('category.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Posts\Category\IndexController::class)->name('index')->middleware('permission:categories_show');
                Route::get('/create', App\Http\Controllers\Admin\Posts\Category\CreateController::class)->name('create')->middleware('permission:categories_create');
                Route::post('/store', App\Http\Controllers\Admin\Posts\Category\StoreController::class)->name('store')->middleware('permission:categories_create');
                Route::get('/{category}', App\Http\Controllers\Admin\Posts\Category\ShowController::class)->name('show')->middleware('permission:categories_show');
                Route::get('/{category}/edit', App\Http\Controllers\Admin\Posts\Category\EditController::class)->name('edit')->middleware('permission:categories_edit');
                Route::patch('/{category}', App\Http\Controllers\Admin\Posts\Category\UpdateController::class)->name('update')->middleware('permission:categories_edit');
                Route::delete('/{category}', App\Http\Controllers\Admin\Posts\Category\DeleteController::class)->name('delete')->middleware('permission:categories_delete');
            });

        Route::prefix('tags')
            ->name('tag.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Posts\Tag\IndexController::class)->name('index')->middleware('permission:tags_show');
                Route::get('/create', App\Http\Controllers\Admin\Posts\Tag\CreateController::class)->name('create')->middleware('permission:tags_create');
                Route::post('/store', App\Http\Controllers\Admin\Posts\Tag\StoreController::class)->name('store')->middleware('permission:tags_create');
                Route::get('/{tag}', App\Http\Controllers\Admin\Posts\Tag\ShowController::class)->name('show')->middleware('permission:tags_show');
                Route::get('/{tag}/edit', App\Http\Controllers\Admin\Posts\Tag\EditController::class)->name('edit')->middleware('permission:tags_edit');
                Route::patch('/{tag}', App\Http\Controllers\Admin\Posts\Tag\UpdateController::class)->name('update')->middleware('permission:tags_edit');
                Route::delete('/{tag}', App\Http\Controllers\Admin\Posts\Tag\DeleteController::class)->name('delete')->middleware('permission:tags_delete');
            });
        Route::prefix('comments')
            ->name('comment.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Posts\Comment\IndexController::class)->name('index')->middleware('permission:comments_show');
                Route::get('/{comment}', App\Http\Controllers\Admin\Posts\Comment\ShowController::class)->name('show')->middleware('permission:comments_show');
                Route::get('/{comment}/edit', App\Http\Controllers\Admin\Posts\Comment\EditController::class)->name('edit')->middleware('permission:comments_edit');
                Route::patch('/{comment}', App\Http\Controllers\Admin\Posts\Comment\UpdateController::class)->name('update')->middleware('permission:comments_edit');
                Route::delete('/{comment}', App\Http\Controllers\Admin\Posts\Comment\DeleteController::class)->name('delete')->middleware('permission:comments_delete');
            });

        Route::prefix('users')
            ->name('user.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Users\User\IndexController::class)->name('index')->middleware('permission:users_show');
                Route::get('/create', App\Http\Controllers\Admin\Users\User\CreateController::class)->name('create')->middleware('permission:users_create');
                Route::post('/store', App\Http\Controllers\Admin\Users\User\StoreController::class)->name('store')->middleware('permission:users_create');
                Route::get('/{user}', App\Http\Controllers\Admin\Users\User\ShowController::class)->name('show')->middleware('permission:users_show');
                Route::get('/{user}/edit', App\Http\Controllers\Admin\Users\User\EditController::class)->name('edit')->middleware('permission:users_edit');
                Route::patch('/{user}', App\Http\Controllers\Admin\Users\User\UpdateController::class)->name('update')->middleware('permission:users_edit');
                Route::delete('/{user}', App\Http\Controllers\Admin\Users\User\DeleteController::class)->name('delete')->middleware('permission:users_delete');
            });

        Route::prefix('role')
            ->name('role.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Users\Role\IndexController::class)->name('index')->middleware('permission:roles_show');
                Route::get('/create', App\Http\Controllers\Admin\Users\Role\CreateController::class)->name('create')->middleware('permission:roles_create');
                Route::post('/store', App\Http\Controllers\Admin\Users\Role\StoreController::class)->name('store')->middleware('permission:roles_create');
                Route::get('/{role}', App\Http\Controllers\Admin\Users\Role\ShowController::class)->name('show')->middleware('permission:roles_show');
                Route::get('/{role}/edit', App\Http\Controllers\Admin\Users\Role\EditController::class)->name('edit')->middleware('permission:roles_edit');
                Route::patch('/{role}', App\Http\Controllers\Admin\Users\Role\UpdateController::class)->name('update')->middleware('permission:roles_edit');
                Route::delete('/{role}', App\Http\Controllers\Admin\Users\Role\DeleteController::class)->name('delete')->middleware('permission:roles_delete');
            });

        Route::prefix('footerlink')
            ->name('footerlink.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Setting\FooterLink\IndexController::class)->name('index');
                Route::get('/create', App\Http\Controllers\Admin\Setting\FooterLink\CreateController::class)->name('create');
                Route::post('/store', App\Http\Controllers\Admin\Setting\FooterLink\StoreController::class)->name('store');
                Route::get('/{link}', App\Http\Controllers\Admin\Setting\FooterLink\ShowController::class)->name('show');
                Route::get('/{link}/edit', App\Http\Controllers\Admin\Setting\FooterLink\EditController::class)->name('edit');
                Route::patch('/{link}', App\Http\Controllers\Admin\Setting\FooterLink\UpdateController::class)->name('update');
                Route::delete('/{link}', App\Http\Controllers\Admin\Setting\FooterLink\DeleteController::class)->name('delete');
            });


        Route::prefix('logs')
            ->name('log.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Setting\Log\IndexController::class)->name('index')->middleware('permission:logs_show');
            });

        Route::prefix('contacts')
            ->name('contact.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Contact\IndexController::class)->name('index')->middleware('permission:contacts_show');
                Route::get('/{contact}', App\Http\Controllers\Admin\Contact\ShowController::class)->name('show')->middleware('permission:contacts_show');
                Route::post('/{contact}/reply', App\Http\Controllers\Admin\Contact\ReplyController::class)->name('reply')->middleware('permission:contacts_create');
                // Route::get('/', App\Http\Controllers\Admin\Setting\Contact\EditController::class)->name('edit')->middleware('permission:settings_show');
                // Route::patch('/', App\Http\Controllers\Admin\Setting\Contact\UpdateController::class)->name('update')->middleware('permission:settings_edit');
            });

        Route::prefix('settings')
            ->name('setting.')
            ->group(function () {

                Route::prefix('comment')
                    ->name('comment.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Comment\EditController::class)->name('edit')->middleware('permission:settings_show');
                        Route::patch('/', App\Http\Controllers\Admin\Setting\Comment\UpdateController::class)->name('update')->middleware('permission:settings_edit');
                    });
                Route::prefix('user')
                    ->name('user.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\User\EditController::class)->name('edit')->middleware('permission:settings_show');
                        Route::patch('/', App\Http\Controllers\Admin\Setting\User\UpdateController::class)->name('update')->middleware('permission:settings_edit');
                    });

                Route::prefix('info')
                    ->name('info.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Info\IndexController::class)->name('index')->middleware('permission:settings_show');
                    });

                Route::prefix('site')
                    ->name('site.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Site\EditController::class)->name('edit')->middleware('permission:settings_edit');
                        Route::patch('/',  App\Http\Controllers\Admin\Setting\Site\UpdateController::class)->name('update')->middleware('permission:settings_edit');
                    });

                Route::prefix('telegram')
                    ->name('telegram.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Telegram\EditController::class)->name('edit')->middleware('permission:settings_edit');
                        Route::patch('/',  App\Http\Controllers\Admin\Setting\Telegram\UpdateController::class)->name('update')->middleware('permission:settings_edit');
                    });
            });
    });