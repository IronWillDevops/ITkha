<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')
    ->middleware(['auth', \App\Http\Middleware\CheckUserVerifiedAndStatus::class, App\Http\Middleware\AdminMiddleware::class])
    ->group(function () {
        Route::redirect('/', '/dashboard');
        Route::get('/dashboard', App\Http\Controllers\Admin\Dashboard\IndexController::class)->name('index');

        Route::prefix('post')
            ->name('post.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Posts\Post\IndexController::class)->name('index')->middleware('permission:post.view');
                Route::get('/create', App\Http\Controllers\Admin\Posts\Post\CreateController::class)->name('create')->middleware('permission:post.create'); // 
                Route::post('/store', App\Http\Controllers\Admin\Posts\Post\StoreController::class)->name('store')->middleware('permission:post.create');
                Route::post('/image-upload', App\Http\Controllers\Admin\Posts\Post\UploadImageController::class)->name('image.upload')->middleware('permission:post.create');
                Route::post('/image-delete', App\Http\Controllers\Admin\Posts\Post\DeleteImageController::class)->name('image.delete')->middleware('permission:post.update');

                Route::get('/{post}', App\Http\Controllers\Admin\Posts\Post\ShowController::class)->name('show')->middleware('permission:post.view');
                Route::get('/{post}/edit', App\Http\Controllers\Admin\Posts\Post\EditController::class)->name('edit')->middleware('permission:post.update');
                Route::patch('/{post}', App\Http\Controllers\Admin\Posts\Post\UpdateController::class)->name('update')->middleware('permission:post.update');
                Route::delete('/{post}', App\Http\Controllers\Admin\Posts\Post\DeleteController::class)->name('delete')->middleware('permission:post.delete');
            });
        Route::prefix('category')
            ->name('category.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Posts\Category\IndexController::class)->name('index')->middleware('permission:category.view');
                Route::get('/create', App\Http\Controllers\Admin\Posts\Category\CreateController::class)->name('create')->middleware('permission:category.create');
                Route::post('/store', App\Http\Controllers\Admin\Posts\Category\StoreController::class)->name('store')->middleware('permission:category.create');
                Route::get('/{category}', App\Http\Controllers\Admin\Posts\Category\ShowController::class)->name('show')->middleware('permission:category.view');
                Route::get('/{category}/edit', App\Http\Controllers\Admin\Posts\Category\EditController::class)->name('edit')->middleware('permission:category.update');
                Route::patch('/{category}', App\Http\Controllers\Admin\Posts\Category\UpdateController::class)->name('update')->middleware('permission:category.update');
                Route::delete('/{category}', App\Http\Controllers\Admin\Posts\Category\DeleteController::class)->name('delete')->middleware('permission:category.delete');
            });

        Route::prefix('tag')
            ->name('tag.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Posts\Tag\IndexController::class)->name('index')->middleware('permission:tag.view');
                Route::get('/create', App\Http\Controllers\Admin\Posts\Tag\CreateController::class)->name('create')->middleware('permission:tag.create');
                Route::post('/store', App\Http\Controllers\Admin\Posts\Tag\StoreController::class)->name('store')->middleware('permission:tag.create');
                Route::get('/{tag}', App\Http\Controllers\Admin\Posts\Tag\ShowController::class)->name('show')->middleware('permission:tag.view');
                Route::get('/{tag}/edit', App\Http\Controllers\Admin\Posts\Tag\EditController::class)->name('edit')->middleware('permission:tag.update');
                Route::patch('/{tag}', App\Http\Controllers\Admin\Posts\Tag\UpdateController::class)->name('update')->middleware('permission:tag.update');
                Route::delete('/{tag}', App\Http\Controllers\Admin\Posts\Tag\DeleteController::class)->name('delete')->middleware('permission:tag.delete');
            });
        Route::prefix('comment')
            ->name('comment.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Posts\Comment\IndexController::class)->name('index')->middleware('permission:comment.view');
                Route::get('/{comment}', App\Http\Controllers\Admin\Posts\Comment\ShowController::class)->name('show')->middleware('permission:comment.view');
                Route::get('/{comment}/edit', App\Http\Controllers\Admin\Posts\Comment\EditController::class)->name('edit')->middleware('permission:comment.update');
                Route::patch('/{comment}', App\Http\Controllers\Admin\Posts\Comment\UpdateController::class)->name('update')->middleware('permission:comment.update');
                Route::delete('/{comment}', App\Http\Controllers\Admin\Posts\Comment\DeleteController::class)->name('delete')->middleware('permission:comment.delete');
            });

        Route::prefix('user')
            ->name('user.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Users\User\IndexController::class)->name('index')->middleware('permission:user.view');
                Route::get('/create', App\Http\Controllers\Admin\Users\User\CreateController::class)->name('create')->middleware('permission:user.create');
                Route::post('/store', App\Http\Controllers\Admin\Users\User\StoreController::class)->name('store')->middleware('permission:user.create');
                Route::get('/{user}', App\Http\Controllers\Admin\Users\User\ShowController::class)->name('show')->middleware('permission:user.view');
                Route::get('/{user}/edit', App\Http\Controllers\Admin\Users\User\EditController::class)->name('edit')->middleware('permission:user.update');
                Route::patch('/{user}', App\Http\Controllers\Admin\Users\User\UpdateController::class)->name('update')->middleware('permission:user.update');
                Route::delete('/{user}', App\Http\Controllers\Admin\Users\User\DeleteController::class)->name('delete')->middleware('permission:user.delete');
            });

        Route::prefix('role')
            ->name('role.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Users\Role\IndexController::class)->name('index')->middleware('permission:role.view');
                Route::get('/create', App\Http\Controllers\Admin\Users\Role\CreateController::class)->name('create')->middleware('permission:role.create');
                Route::post('/store', App\Http\Controllers\Admin\Users\Role\StoreController::class)->name('store')->middleware('permission:role.create');
                Route::get('/{role}', App\Http\Controllers\Admin\Users\Role\ShowController::class)->name('show')->middleware('permission:role.view');
                Route::get('/{role}/edit', App\Http\Controllers\Admin\Users\Role\EditController::class)->name('edit')->middleware('permission:role.update');
                Route::patch('/{role}', App\Http\Controllers\Admin\Users\Role\UpdateController::class)->name('update')->middleware('permission:role.update');
                Route::delete('/{role}', App\Http\Controllers\Admin\Users\Role\DeleteController::class)->name('delete')->middleware('permission:role.delete');
            });





        Route::prefix('contact')
            ->name('contact.')
            ->group(function () {
                Route::get('/', App\Http\Controllers\Admin\Contact\IndexController::class)->name('index')->middleware('permission:contact.view');
                Route::get('/{contact}', App\Http\Controllers\Admin\Contact\ShowController::class)->name('show')->middleware('permission:contact.update');
                Route::post('/{contact}/reply', App\Http\Controllers\Admin\Contact\ReplyController::class)->name('reply')->middleware('permission:contact.update');
            });

        Route::prefix('setting')
            ->name('setting.')
            ->group(function () {

                Route::prefix('comment')
                    ->name('comment.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Comment\EditController::class)->name('edit')->middleware('permission:setting.update');
                        Route::patch('/', App\Http\Controllers\Admin\Setting\Comment\UpdateController::class)->name('update')->middleware('permission:setting.update');
                    });
                Route::prefix('policy')
                    ->name('policy.')
                    ->group(function () {
                         Route::get('/', App\Http\Controllers\Admin\Setting\Policy\IndexController::class)->name('index')->middleware('permission:setting.view');
                         Route::get('/create', App\Http\Controllers\Admin\Setting\Policy\CreateController::class)->name('create')->middleware('permission:setting.create');
                         Route::post('/store', App\Http\Controllers\Admin\Setting\Policy\StoreController::class)->name('store')->middleware('permission:setting.create');
                         Route::get('/{policy}/edit', App\Http\Controllers\Admin\Setting\Policy\EditController::class)->name('edit')->middleware('permission:setting.update');
                         Route::patch('/{policy}', App\Http\Controllers\Admin\Setting\Policy\UpdateController::class)->name('update')->middleware('permission:setting.update');
                    });
                Route::prefix('footerlink')
                    ->name('footerlink.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\FooterLink\IndexController::class)->name('index')->middleware('permission:setting.view');
                        Route::get('/create', App\Http\Controllers\Admin\Setting\FooterLink\CreateController::class)->name('create')->middleware('permission:setting.create');
                        Route::post('/store', App\Http\Controllers\Admin\Setting\FooterLink\StoreController::class)->name('store')->middleware('permission:setting.create');
                        Route::get('/{link}', App\Http\Controllers\Admin\Setting\FooterLink\ShowController::class)->name('show')->middleware('permission:setting.view');
                        Route::get('/{link}/edit', App\Http\Controllers\Admin\Setting\FooterLink\EditController::class)->name('edit')->middleware('permission:setting.update');
                        Route::patch('/{link}', App\Http\Controllers\Admin\Setting\FooterLink\UpdateController::class)->name('update')->middleware('permission:setting.update');
                        Route::delete('/{link}', App\Http\Controllers\Admin\Setting\FooterLink\DeleteController::class)->name('delete')->middleware('permission:setting.delete');
                    });
                Route::prefix('user')
                    ->name('user.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\User\EditController::class)->name('edit')->middleware('permission:setting.update');
                        Route::patch('/', App\Http\Controllers\Admin\Setting\User\UpdateController::class)->name('update')->middleware('permission:setting.update');
                    });

                Route::prefix('info')
                    ->name('info.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Info\IndexController::class)->name('index')->middleware('permission:setting.view');
                    });

                Route::prefix('site')
                    ->name('site.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Site\EditController::class)->name('edit')->middleware('permission:setting.update');
                        Route::patch('/',  App\Http\Controllers\Admin\Setting\Site\UpdateController::class)->name('update')->middleware('permission:setting.update');
                    });

                Route::prefix('log')
                    ->name('log.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Log\IndexController::class)->name('index')->middleware('permission:log.view');
                    });


                Route::prefix('telegram')
                    ->name('telegram.')
                    ->group(function () {
                        Route::get('/', App\Http\Controllers\Admin\Setting\Telegram\EditController::class)->name('edit')->middleware('permission:setting.update');
                        Route::patch('/',  App\Http\Controllers\Admin\Setting\Telegram\UpdateController::class)->name('update')->middleware('permission:setting.update');
                    });
            });
    });
// admin
Route::prefix('admin')->middleware('auth')->group(function () {});
