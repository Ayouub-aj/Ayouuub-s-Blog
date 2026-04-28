<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->whereNumber('article')
    ->name('articles.show');
Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->whereNumber('category')
    ->name('categories.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->whereNumber('article')
        ->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])
        ->whereNumber('article')
        ->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->whereNumber('article')
        ->name('articles.destroy');

    Route::prefix('dashboard/categories')->name('manage.categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])
            ->whereNumber('category')
            ->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])
            ->whereNumber('category')
            ->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])
            ->whereNumber('category')
            ->name('destroy');
    });

    Route::prefix('dashboard/users')->name('manage.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])
            ->whereNumber('user')
            ->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])
            ->whereNumber('user')
            ->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])
            ->whereNumber('user')
            ->name('destroy');
    });
});