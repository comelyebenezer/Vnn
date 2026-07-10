@extends('layouts.frontend')

@section('title', $article->title)

@section('content')
<article class="max-w-4xl mx-auto px-4 py-8">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-6 font-body">
        <a href="/" class="hover:text-vnn-red">Home</a>
        <span>/</span>
        <a href="/" class="hover:text-vnn-red">Social Trends</a>
        <span>/</span>
        <span class="text-gray-400 dark:text-gray-500 truncate">{{ $article->title }}</span>
    </div>

    {{-- Title --}}
    <h1 class="text-3xl md:text-4xl font-extrabold leading-tight text-vnn-dark dark:text-white font-heading">{{ $article->title }}</h1>

    {{-- Meta --}}
    <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 pb-4 font-body">
        <span class="font-bold text-vnn-red">VNN</span>
        <span>|</span>
        <span>{{ $article->created_at->format('M d, Y') }}</span>
        @if($article->social_platform)
        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
            {{ ucfirst($article->social_platform) }}
        </span>
        @endif
    </div>

    {{-- Media --}}
    <div class="mt-6">
        @if($article->media_content_type === 'image' && $article->image_file)
            <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <img src="{{ asset('storage/' . $article->image_file) }}" alt="{{ $article->title }}" class="w-full object-cover">
            </div>
        @elseif($article->media_content_type === 'video')
            @if($article->media_file)
                <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                    <video class="w-full" controls playsinline>
                        <source src="{{ asset('storage/' . $article->media_file) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @elseif($article->youtube_url)
                @php
                    $url = $article->youtube_url;
                    $platform = $article->social_platform ?? 'other';
                    $embedUrl = null;

                    if ($platform === 'youtube') {
                        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $m[1];
                        }
                    } elseif ($platform === 'facebook') {
                        if (str_contains($url, 'facebook.com') && !str_contains($url, '/plugins/video.php')) {
                            $embedUrl = 'https://www.facebook.com/plugins/video.php?href=' . urlencode($url);
                        } else {
                            $embedUrl = $url;
                        }
                    } elseif ($platform === 'vimeo') {
                        if (preg_match('/(?:vimeo\.com\/)(\d+)/', $url, $m)) {
                            $embedUrl = 'https://player.vimeo.com/video/' . $m[1];
                        }
                    }
                @endphp
                @if($embedUrl)
                <div class="aspect-video rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                    <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                </div>
                @else
                <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 p-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Watch this video on {{ ucfirst($platform) }}</p>
                    <a href="{{ $url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-vnn-red text-white text-sm font-bold px-6 py-3 rounded-lg hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                        Open on {{ ucfirst($platform) }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
                @endif
            @endif
        @endif
    </div>

    {{-- Excerpt --}}
    @if($article->excerpt)
    <p class="text-lg text-gray-500 dark:text-gray-400 mt-4 leading-relaxed font-body">{{ $article->excerpt }}</p>
    @endif

    {{-- Body --}}
    @if($article->body)
    <div class="mt-6 text-gray-700 dark:text-gray-300 leading-relaxed font-body text-base prose prose-lg dark:prose-invert max-w-none">
        {!! $article->body !!}
    </div>
    @endif

    {{-- Tags --}}
    @if($article->tags->count())
    <div class="mt-8 flex flex-wrap gap-2">
        @foreach($article->tags as $tag)
        <a href="{{ route('frontend.tag', $tag->slug) }}" class="px-3 py-1.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-xs font-medium rounded-lg hover:bg-vnn-red hover:text-white transition">#{{ $tag->name }}</a>
        @endforeach
    </div>
    @endif

    {{-- Back --}}
    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <a href="/" class="text-vnn-red hover:underline text-sm font-semibold">&larr; Back to Social Trends</a>
    </div>
</article>
@endsection
