<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplatesController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogLikeController;
use App\Http\Controllers\BlogCommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/templates', [TemplatesController::class, 'index']);

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware('auth')->group(function () {
    Route::post('/blog/{post}/like', [BlogLikeController::class, 'toggle'])->name('blog.like');
    Route::post('/blog/{post}/comments', [BlogCommentController::class, 'store'])->name('blog.comments.store');
    Route::delete('/blog/comments/{comment}', [BlogCommentController::class, 'destroy'])->name('blog.comments.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| These will be protected by auth/admin middleware once authentication
| is implemented. For now they are accessible for development purposes.
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('templates', TemplateController::class);
    Route::get('templates/{template}/preview', [TemplateController::class, 'preview'])
        ->name('templates.preview');
});
