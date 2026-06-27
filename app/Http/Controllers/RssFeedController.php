<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RssFeedController extends Controller
{
    public function __invoke(): Response
    {
        $articles = Article::with(['author', 'category'])
            ->where('status', 'published')
            ->latest('publication_date')
            ->limit(50)
            ->get();

        $siteName = config('app.name');
        $siteUrl = url('/');
        $tagline = config('app.tagline');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/">';
        $xml .= '<channel>';
        $xml .= "<title>{$siteName}</title>";
        $xml .= "<link>{$siteUrl}</link>";
        $xml .= "<description>{$tagline}</description>";
        $xml .= "<language>en</language>";
        $xml .= "<lastBuildDate>" . now()->toRssString() . "</lastBuildDate>";
        $xml .= "<atom:link href=\"{$siteUrl}/rss\" rel=\"self\" type=\"application/rss+xml\"/>";

        foreach ($articles as $article) {
            $xml .= '<item>';
            $xml .= '<title><![CDATA[' . $article->title . ']]></title>';
            $xml .= "<link>{$siteUrl}/article/{$article->slug}</link>";
            $xml .= '<guid isPermaLink="true">' . "{$siteUrl}/article/{$article->slug}" . '</guid>';
            $xml .= '<description><![CDATA[' . $article->excerpt . ']]></description>';

            if ($article->featured_image) {
                $imageUrl = asset('storage/' . $article->featured_image);
                $xml .= "<media:content url=\"{$imageUrl}\" medium=\"image\"/>";
                $xml .= "<enclosure url=\"{$imageUrl}\" type=\"image/jpeg\"/>";
            }

            if ($article->category) {
                $xml .= '<category>' . e($article->category->name) . '</category>';
            }

            if ($article->author) {
                $xml .= '<author>' . e($article->author->email ?? '') . ' (' . e($article->author->name) . ')</author>';
            }

            $pubDate = $article->publication_date?->toRssString()
                ?? $article->created_at->toRssString();
            $xml .= "<pubDate>{$pubDate}</pubDate>";

            $xml .= '</item>';
        }

        $xml .= '</channel>';
        $xml .= '</rss>';

        return response($xml, 200, [
            'Content-Type' => 'application/rss+xml; charset=UTF-8',
        ]);
    }
}
