@extends('layouts.frontend')

@push('meta')
<x-seo-meta :model="$article" type="article" />
@endpush

@section('title', $article->title)

@section('content')
<article class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Article --}}
        <div class="lg:col-span-2">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-4 font-body">
                <a href="/" class="hover:text-vnn-red">Home</a>
                <span>/</span>
                @if($article->category)
                <a href="{{ route('frontend.category', $article->category->slug) }}" class="hover:text-vnn-red">{{ $article->category->name }}</a>
                <span>/</span>
                @endif
                <span class="text-gray-400 dark:text-gray-500 truncate">{{ $article->title }}</span>
            </div>

            {{-- Category Badge --}}
            @if($article->category)
            <a href="{{ route('frontend.category', $article->category->slug) }}" class="text-vnn-red text-xs font-bold uppercase tracking-wider hover:underline">{{ $article->category->name }}</a>
            @endif

            {{-- Headline --}}
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold leading-tight mt-2 text-vnn-dark dark:text-white font-heading">{{ $article->title }}</h1>

            {{-- Excerpt --}}
            @if($article->excerpt)
            <p class="text-lg text-gray-500 dark:text-gray-400 mt-4 leading-relaxed font-body">{{ $article->excerpt }}</p>
            @endif

            {{-- Meta --}}
            <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 pb-4 font-body">
                <div class="flex items-center gap-2">
                    <span class="text-gray-400">Published by</span>
                    <span class="font-bold text-vnn-red">VNN</span>
                </div>
                <span>|</span>
                @if($article->editor)
                <div class="flex items-center gap-2">
                    <span class="text-gray-400">Edited by:</span>
                    <a href="{{ route('frontend.author', $article->editor->id) }}" class="font-semibold text-gray-700 dark:text-gray-200 hover:text-vnn-red">{{ $article->editor->name }}</a>
                </div>
                @endif
                <span>|</span>
                <span>{{ $article->publication_date ? $article->publication_date->format('F j, Y') : $article->created_at->format('F j, Y') }}</span>
            </div>

        </div>
    </div>

    {{-- Video Player --}}
    @if($article->type === 'video')
    <div class="w-full max-w-7xl mx-auto px-4 mt-6">
        <div class="relative w-full overflow-hidden rounded-xl">
            @if($article->youtube_id)
            <div class="relative w-full" style="padding-top: 56.25%;">
                <iframe src="https://www.youtube.com/embed/{{ $article->youtube_id }}" class="absolute inset-0 w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            @elseif($article->media_file && $article->media_type === 'video')
            <video src="{{ asset('storage/' . $article->media_file) }}" controls class="w-full max-h-[500px] bg-black"></video>
            @endif
        </div>
    </div>

    {{-- Featured Image Hero (non-video) --}}
    @elseif($article->featured_image)
    <div class="w-full max-w-7xl mx-auto px-4 mt-6">
        <div class="relative w-full overflow-hidden rounded-xl">
            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-auto max-h-[500px] object-cover">
            @if($article->image_caption)
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                <p class="text-sm text-white/90 italic font-body">{{ $article->image_caption }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Article --}}
        <div class="lg:col-span-2">

            {{-- Article Body --}}
            <div class="mt-8 prose prose-lg max-w-none overflow-x-auto prose-headings:text-vnn-dark dark:prose-headings:text-white prose-a:text-vnn-red prose-a:no-underline hover:prose-a:underline prose-img:rounded dark:prose-invert font-body">
                {!! $article->body !!}
            </div>

            {{-- Tags --}}
            @if($article->tags->count())
            <div class="mt-8 flex flex-wrap gap-2">
                @foreach($article->tags as $tag)
                <a href="{{ route('frontend.tag', $tag->slug) }}" class="bg-vnn-gray dark:bg-vnn-dark-light text-gray-600 dark:text-gray-300 text-xs font-medium px-3 py-1.5 rounded hover:bg-vnn-red hover:text-white transition">{{ $tag->name }}</a>
                @endforeach
            </div>
            @endif

            {{-- Share Buttons --}}
            <div class="mt-8 flex flex-wrap items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-vnn-gray dark:bg-vnn-dark-light rounded">
                <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">Share:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs hover:bg-blue-700 transition">f</a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="w-8 h-8 bg-black text-white rounded-full flex items-center justify-center text-xs hover:bg-gray-800 transition">X</a>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-xs hover:bg-green-700 transition">W</a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" class="w-8 h-8 bg-blue-800 text-white rounded-full flex items-center justify-center text-xs hover:bg-blue-900 transition">in</a>
                <a href="mailto:?subject={{ urlencode($article->title) }}&body={{ urlencode(url()->current()) }}" class="w-8 h-8 bg-gray-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-gray-600 transition">@</a>
            </div>

            {{-- Updated Date --}}
            @if($article->updated_at && $article->updated_at != $article->created_at)
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-4 font-body">Last updated: {{ $article->updated_at->format('F j, Y \a\t H:i T') }}</p>
            @endif

            {{-- Comments --}}
            @if($article->allow_comments)
            <div class="mt-10 border-t border-gray-200 dark:border-gray-700 pt-8">
                @livewire('article-comments', ['article' => $article], key('comments-'.$article->id))
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <aside class="space-y-8">
            {{-- Related Articles --}}
            @if($related->count())
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Related</h3>
                    <div class="flex-1"></div>
                </div>
                <div class="space-y-4">
                    @foreach($related as $rel)
                    <a href="{{ route('frontend.article', $rel->slug) }}" class="group flex gap-3">
                        <div class="w-20 h-16 bg-vnn-dark rounded overflow-hidden shrink-0 flex items-center justify-center">
                            @if($rel->featured_image)
                            <img src="{{ asset('storage/' . $rel->featured_image) }}" alt="{{ $rel->title }}" class="w-full h-full object-cover">
                            @else
                            <span class="text-white/20 font-extrabold text-lg">G</span>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $rel->title }}</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body">{{ $rel->publication_date?->diffForHumans() ?? $rel->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Trending --}}
            @if($trending->count())
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Trending</h3>
                    <div class="flex-1"></div>
                </div>
                <div class="space-y-4">
                    @foreach($trending as $i => $trend)
                    <a href="{{ route('frontend.article', $trend->slug) }}" class="flex gap-3 group">
                        @if($trend->featured_image)
                        <img src="{{ asset('storage/' . $trend->featured_image) }}" alt="{{ $trend->title }}" class="w-20 h-14 object-cover rounded-lg shrink-0 group-hover:opacity-80 transition">
                        @else
                        <div class="w-20 h-14 bg-gray-200 dark:bg-gray-700 rounded-lg shrink-0 flex items-center justify-center">
                            <span class="text-lg font-extrabold text-gray-400 dark:text-gray-500">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        @endif
                        <div class="min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $trend->title }}</h4>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Ad --}}
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-64 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>

            {{-- Newsletter --}}
            <div class="bg-vnn-dark rounded-lg p-6 text-white">
                <h3 class="font-extrabold text-lg font-heading">Stay Informed</h3>
                <p class="text-sm text-gray-300 mt-1 font-body">Get the latest news delivered to your inbox.</p>
                @livewire('newsletter-subscribe', ['layout' => 'vertical'], key('article-subscribe'))
            </div>
        </aside>
    </div>
    </div>
</article>
@endsection