<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');
});

Route::prefix('')->name('frontend.')->group(function () {
    Route::get('/article/{slug}', [\App\Http\Controllers\Frontend\ArticleController::class, 'show'])->name('article');
    Route::get('/category/{slug}', [\App\Http\Controllers\Frontend\ArticleController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [\App\Http\Controllers\Frontend\ArticleController::class, 'tag'])->name('tag');
    Route::get('/author/{id}', \App\Http\Controllers\Frontend\AuthorController::class)->name('author');
});

Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/rss', [\App\Http\Controllers\RssFeedController::class, '__invoke'])->name('rss');
Route::get('/feed', [\App\Http\Controllers\RssFeedController::class, '__invoke']);

Route::get('/api/search', \App\Http\Controllers\Api\SearchController::class)->name('api.search');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
