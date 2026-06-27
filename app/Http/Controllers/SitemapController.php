<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create('/')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
            ->setPriority(1.0));

        $sitemap->add(Url::create('/about')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.3));

        $sitemap->add(Url::create('/contact')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.3));

        Article::where('status', 'published')->chunk(100, function ($articles) use ($sitemap) {
            foreach ($articles as $article) {
                $sitemap->add(
                    Url::create("/article/{$article->slug}")
                        ->setLastModificationDate($article->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8)
                );
            }
        });

        Category::chunk(100, function ($categories) use ($sitemap) {
            foreach ($categories as $category) {
                $sitemap->add(
                    Url::create("/category/{$category->slug}")
                        ->setLastModificationDate($category->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.7)
                );
            }
        });

        Tag::chunk(100, function ($tags) use ($sitemap) {
            foreach ($tags as $tag) {
                $sitemap->add(
                    Url::create("/tag/{$tag->slug}")
                        ->setLastModificationDate($tag->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.4)
                );
            }
        });

        return $sitemap->toResponse(request());
    }
}
