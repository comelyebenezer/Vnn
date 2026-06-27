@php
    if (isset($model) && $model) {
        $seo = $model->seo ?? collect();
        $metaDescription = $seo['meta_description'] ?? $model->excerpt ?? $model->description ?? '';
        $metaKeywords = $seo['keywords'] ?? '';
        $canonicalUrl = $seo['canonical_url'] ?? url()->current();
        $ogTitle = $seo['og_title'] ?? $model->title ?? '';
        $ogDescription = $seo['og_description'] ?? $metaDescription;
        $ogType = $seo['og_type'] ?? ($type ?? 'article');
        $ogImage = $seo['og_image'] ?? ($model->featured_image ?? '');
        $twitterTitle = $seo['twitter_title'] ?? $ogTitle;
        $twitterDescription = $seo['twitter_description'] ?? $ogDescription;
        $twitterImage = $seo['twitter_image'] ?? $ogImage;
        $twitterCard = $seo['twitter_card'] ?? 'summary_large_image';
        $schemaMarkup = $seo['schema_markup'] ?? '';
    } else {
        $metaDescription = $description ?? '';
        $metaKeywords = $keywords ?? '';
        $canonicalUrl = $canonical ?? url()->current();
        $ogTitle = $og_title ?? '';
        $ogDescription = $og_description ?? $metaDescription;
        $ogType = $og_type ?? ($type ?? 'website');
        $ogImage = $og_image ?? '';
        $twitterTitle = $twitter_title ?? $ogTitle;
        $twitterDescription = $twitter_description ?? $ogDescription;
        $twitterImage = $twitter_image ?? $ogImage;
        $twitterCard = $twitter_card ?? 'summary_large_image';
        $schemaMarkup = $schema ?? '';
    }
@endphp
@if($metaDescription)
<meta name="description" content="{{ $metaDescription }}">
@endif
@if($metaKeywords)
<meta name="keywords" content="{{ $metaKeywords }}">
@endif
@if($canonicalUrl)
<link rel="canonical" href="{{ $canonicalUrl }}">
@endif
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
@if($ogImage)
<meta property="og:image" content="{{ \Illuminate\Support\Str::startsWith($ogImage, 'http') ? $ogImage : asset('storage/' . $ogImage) }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
@endif
<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $twitterTitle }}">
<meta name="twitter:description" content="{{ $twitterDescription }}">
@if($twitterImage)
<meta name="twitter:image" content="{{ \Illuminate\Support\Str::startsWith($twitterImage, 'http') ? $twitterImage : asset('storage/' . $twitterImage) }}">
@endif
@if($schemaMarkup)
<script type="application/ld+json">{!! $schemaMarkup !!}</script>
@endif