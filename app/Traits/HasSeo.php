<?php

namespace App\Traits;

use App\Models\Seo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeo
{
    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function seos(): MorphMany
    {
        return $this->morphMany(Seo::class, 'seoable');
    }

    public function getSeoMeta(): array
    {
        $seo = $this->seo;

        if (!$seo) {
            return [
                'meta_title' => $this->title ?? $this->name ?? config('app.name'),
                'meta_description' => $this->excerpt ?? $this->description ?? config('app.tagline'),
                'keywords' => '',
                'canonical_url' => url()->current(),
                'og_title' => $this->title ?? $this->name ?? config('app.name'),
                'og_description' => $this->excerpt ?? $this->description ?? config('app.tagline'),
                'og_image' => $this->featured_image ?? '',
                'twitter_card' => 'summary_large_image',
                'twitter_title' => $this->title ?? $this->name ?? config('app.name'),
                'twitter_description' => $this->excerpt ?? $this->description ?? config('app.tagline'),
                'twitter_image' => $this->featured_image ?? '',
                'schema_markup' => null,
            ];
        }

        return [
            'meta_title' => $seo->meta_title ?: ($this->title ?? $this->name ?? config('app.name')),
            'meta_description' => $seo->meta_description ?: ($this->excerpt ?? $this->description ?? config('app.tagline')),
            'keywords' => $seo->keywords ?? '',
            'canonical_url' => $seo->canonical_url ?? url()->current(),
            'og_title' => $seo->og_title ?: ($this->title ?? $this->name ?? config('app.name')),
            'og_description' => $seo->og_description ?: ($this->excerpt ?? $this->description ?? config('app.tagline')),
            'og_image' => $seo->og_image ?: ($this->featured_image ?? ''),
            'twitter_card' => $seo->twitter_card ?? 'summary_large_image',
            'twitter_title' => $seo->twitter_title ?: ($this->title ?? $this->name ?? config('app.name')),
            'twitter_description' => $seo->twitter_description ?: ($this->excerpt ?? $this->description ?? config('app.tagline')),
            'twitter_image' => $seo->twitter_image ?: ($this->featured_image ?? ''),
            'schema_markup' => $seo->schema_markup,
        ];
    }
}
