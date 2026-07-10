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
    Route::get('/live/{id}', [\App\Http\Controllers\Frontend\LiveUpdateController::class, 'show'])->name('live');
    Route::get('/social-trend/{slug}', [\App\Http\Controllers\Frontend\SocialTrendController::class, 'show'])->name('social-trend');
    Route::get('/video', \App\Http\Controllers\Frontend\VideoController::class)->name('video');
    Route::get('/podcast', \App\Http\Controllers\Frontend\PodcastController::class)->name('podcast');
    Route::get('/vnn-list', \App\Http\Controllers\Frontend\VnnListController::class)->name('vnn-list');
    Route::get('/documentary', \App\Http\Controllers\Frontend\DocumentaryController::class)->name('documentary');
    Route::get('/tech-start-ups', \App\Http\Controllers\Frontend\TechStartUpsController::class)->name('tech-start-ups');
    Route::get('/latest-gadgets', \App\Http\Controllers\Frontend\LatestGadgetsController::class)->name('latest-gadgets');
});

Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/rss', [\App\Http\Controllers\RssFeedController::class, '__invoke'])->name('rss');
Route::get('/feed', [\App\Http\Controllers\RssFeedController::class, '__invoke']);

Route::get('/api/search', \App\Http\Controllers\Api\SearchController::class)->name('api.search');

Route::get('/unsubscribe/{token}', function ($token) {
    $subscriber = \App\Models\Subscriber::where('unsubscribe_token', $token)->firstOrFail();
    $subscriber->update(['status' => 'unsubscribed']);
    return view('frontend.unsubscribed');
})->name('newsletter.unsubscribe');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
