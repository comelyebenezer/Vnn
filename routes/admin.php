<?php

use App\Http\Livewire\Admin\Advertisements\AdvertisementList;
use App\Http\Livewire\Admin\Advertisements\AdvertisementManager;
use App\Http\Livewire\Admin\Articles\ArticleList;
use App\Http\Livewire\Admin\Articles\ArticleManager;
use App\Http\Livewire\Admin\VnnList\VnnListList;
use App\Http\Livewire\Admin\VnnList\VnnListManager;
use App\Http\Livewire\Admin\Documentary\DocumentaryList;
use App\Http\Livewire\Admin\Documentary\DocumentaryManager;
use App\Http\Livewire\Admin\TechStartUps\TechStartUpsList;
use App\Http\Livewire\Admin\TechStartUps\TechStartUpsManager;
use App\Http\Livewire\Admin\LatestGadgets\LatestGadgetsList;
use App\Http\Livewire\Admin\LatestGadgets\LatestGadgetsManager;
use App\Http\Livewire\Admin\SocialTrends\SocialTrendsList;
use App\Http\Livewire\Admin\SocialTrends\SocialTrendsManager;
use App\Http\Livewire\Admin\LatestRelease\LatestReleaseList;
use App\Http\Livewire\Admin\LatestRelease\LatestReleaseManager;
use App\Http\Livewire\Admin\Authors\AuthorList;
use App\Http\Livewire\Admin\Authors\AuthorManager;
use App\Http\Livewire\Admin\BreakingNews\BreakingNewsList;
use App\Http\Livewire\Admin\BreakingNews\BreakingNewsManager;
use App\Http\Livewire\Admin\Categories\CategoryList;
use App\Http\Livewire\Admin\Categories\CategoryManager;
use App\Http\Livewire\Admin\Comments\CommentList;
use App\Http\Livewire\Admin\FactCheckers\FactCheckerList;
use App\Http\Livewire\Admin\FactCheckers\FactCheckerManager;
use App\Http\Livewire\Admin\Newsletter\NewsletterList;
use App\Http\Livewire\Admin\Newsletter\NewsletterManager;
use App\Http\Livewire\Admin\Roles\RoleList;
use App\Http\Livewire\Admin\Roles\RoleManager;
use App\Http\Livewire\Admin\Users\UserList;
use App\Http\Livewire\Admin\Users\UserManager;
use App\Http\Livewire\Admin\Publishers\PublisherList;
use App\Http\Livewire\Admin\Publishers\PublisherManager;
use App\Http\Livewire\Admin\Seo\SeoManager;
use App\Http\Livewire\Admin\Settings\SettingsManager;
use App\Http\Livewire\Admin\Subscribers\SubscriberList;
use App\Http\Livewire\Admin\Tags\TagList;
use App\Http\Livewire\Admin\Tags\TagManager;
use App\Http\Livewire\Admin\Media\MediaList;
use App\Http\Livewire\Admin\Media\MediaManager;
use App\Http\Livewire\Admin\Videos\VideoList;
use App\Http\Livewire\Admin\Videos\VideoManager;
use App\Http\Livewire\Admin\Podcasts\PodcastList;
use App\Http\Livewire\Admin\Podcasts\PodcastManager;
use App\Http\Livewire\Admin\Live\LiveList;
use App\Http\Livewire\Admin\Live\LiveManager;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Http\Livewire\Admin\Dashboard::class)->name('dashboard');

    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/', ArticleList::class)->name('index');
        Route::get('/create', ArticleManager::class)->name('create');
        Route::get('/{article}/edit', ArticleManager::class)->name('edit');
    });

    Route::prefix('vnn-list')->name('vnn-list.')->group(function () {
        Route::get('/', VnnListList::class)->name('index');
        Route::get('/create', VnnListManager::class)->name('create');
        Route::get('/{article}/edit', VnnListManager::class)->name('edit');
    });

    Route::prefix('documentary')->name('documentary.')->group(function () {
        Route::get('/', DocumentaryList::class)->name('index');
        Route::get('/create', DocumentaryManager::class)->name('create');
        Route::get('/{article}/edit', DocumentaryManager::class)->name('edit');
    });

    Route::prefix('tech-start-ups')->name('tech-start-ups.')->group(function () {
        Route::get('/', TechStartUpsList::class)->name('index');
        Route::get('/create', TechStartUpsManager::class)->name('create');
        Route::get('/{article}/edit', TechStartUpsManager::class)->name('edit');
    });

    Route::prefix('latest-gadgets')->name('latest-gadgets.')->group(function () {
        Route::get('/', LatestGadgetsList::class)->name('index');
        Route::get('/create', LatestGadgetsManager::class)->name('create');
        Route::get('/{article}/edit', LatestGadgetsManager::class)->name('edit');
    });

    Route::prefix('social-trends')->name('social-trends.')->group(function () {
        Route::get('/', SocialTrendsList::class)->name('index');
        Route::get('/create', SocialTrendsManager::class)->name('create');
        Route::get('/{article}/edit', SocialTrendsManager::class)->name('edit');
    });

    Route::prefix('latest-release')->name('latest-release.')->group(function () {
        Route::get('/', LatestReleaseList::class)->name('index');
        Route::get('/create', LatestReleaseManager::class)->name('create');
        Route::get('/{article}/edit', LatestReleaseManager::class)->name('edit');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', CategoryList::class)->name('index');
        Route::get('/create', CategoryManager::class)->name('create');
        Route::get('/{category}/edit', CategoryManager::class)->name('edit');
    });

    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', MediaList::class)->name('index');
        Route::get('/create', MediaManager::class)->name('create');
    });

    Route::prefix('videos')->name('videos.')->group(function () {
        Route::get('/', VideoList::class)->name('index');
        Route::get('/create', VideoManager::class)->name('create');
        Route::get('/{video}/edit', VideoManager::class)->name('edit');
    });

    Route::prefix('podcasts')->name('podcasts.')->group(function () {
        Route::get('/', PodcastList::class)->name('index');
        Route::get('/create', PodcastManager::class)->name('create');
        Route::get('/{podcast}/edit', PodcastManager::class)->name('edit');
    });

    Route::prefix('live')->name('live.')->group(function () {
        Route::get('/', LiveList::class)->name('index');
        Route::get('/create', LiveManager::class)->name('create');
        Route::get('/{live}/edit', LiveManager::class)->name('edit');
    });

    Route::prefix('tags')->name('tags.')->group(function () {
        Route::get('/', TagList::class)->name('index');
        Route::get('/create', TagManager::class)->name('create');
        Route::get('/{tag}/edit', TagManager::class)->name('edit');
    });

    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/', CommentList::class)->name('index');
    });

    Route::prefix('breaking-news')->name('breaking-news.')->group(function () {
        Route::get('/', BreakingNewsList::class)->name('index');
        Route::get('/create', BreakingNewsManager::class)->name('create');
        Route::get('/{breakingnews}/edit', BreakingNewsManager::class)->name('edit');
    });

    Route::prefix('seo')->name('seo.')->group(function () {
        Route::get('/{type}/{id}', SeoManager::class)->name('edit');
    });

    Route::prefix('advertisements')->name('advertisements.')->group(function () {
        Route::get('/', AdvertisementList::class)->name('index');
        Route::get('/create', AdvertisementManager::class)->name('create');
        Route::get('/{advertisement}/edit', AdvertisementManager::class)->name('edit');
    });

    Route::prefix('ticker')->name('ticker.')->group(function () {
        Route::get('/', \App\Http\Livewire\Admin\Ticker\TickerList::class)->name('index');
        Route::get('/create', \App\Http\Livewire\Admin\Ticker\TickerManager::class)->name('create');
        Route::get('/{ticker}/edit', \App\Http\Livewire\Admin\Ticker\TickerManager::class)->name('edit');
    });

    Route::prefix('authors')->name('authors.')->group(function () {
        Route::get('/', AuthorList::class)->name('index');
        Route::get('/create', AuthorManager::class)->name('create');
        Route::get('/{author}/edit', AuthorManager::class)->name('edit');
    });

    Route::prefix('publishers')->name('publishers.')->group(function () {
        Route::get('/', PublisherList::class)->name('index');
        Route::get('/create', PublisherManager::class)->name('create');
        Route::get('/{publisher}/edit', PublisherManager::class)->name('edit');
    });

    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', \App\Http\Livewire\Admin\Gallery\GalleryList::class)->name('index');
        Route::get('/create', \App\Http\Livewire\Admin\Gallery\GalleryManager::class)->name('create');
        Route::get('/{gallery}/edit', \App\Http\Livewire\Admin\Gallery\GalleryManager::class)->name('edit');
    });

    Route::prefix('fact-checkers')->name('fact-checkers.')->group(function () {
        Route::get('/', FactCheckerList::class)->name('index');
        Route::get('/create', FactCheckerManager::class)->name('create');
        Route::get('/{factChecker}/edit', FactCheckerManager::class)->name('edit');
    });

    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/', NewsletterList::class)->name('index');
        Route::get('/create', NewsletterManager::class)->name('create');
        Route::get('/{newsletter}/edit', NewsletterManager::class)->name('edit');
    });

    Route::prefix('subscribers')->name('subscribers.')->group(function () {
        Route::get('/', SubscriberList::class)->name('index');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', UserList::class)->name('index');
        Route::get('/create', UserManager::class)->name('create');
        Route::get('/{user}/edit', UserManager::class)->name('edit');
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', RoleList::class)->name('index');
        Route::get('/create', RoleManager::class)->name('create');
        Route::get('/{role}/edit', RoleManager::class)->name('edit');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', SettingsManager::class)->name('index');
    });

    Route::get('/sitemap/refresh', function () {
        abort_unless(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'), 403);
        \Illuminate\Support\Facades\Artisan::call('sitemap:generate');
        return back()->with('success', 'Sitemap regenerated successfully.');
    })->name('sitemap.refresh');
});
