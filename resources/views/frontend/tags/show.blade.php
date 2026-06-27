@extends('layouts.frontend')

@section('title', 'Tag: ' . $tag->name)

@section('content')
<section class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-2 font-body">
            <a href="/" class="hover:text-vnn-red">Home</a>
            <span>/</span>
            <span class="text-gray-400 dark:text-gray-500">Tag: {{ $tag->name }}</span>
        </div>
        <div class="flex items-center gap-4 border-b-2 border-vnn-red pb-2">
            <h1 class="text-3xl font-extrabold text-vnn-dark dark:text-white font-heading">#{{ $tag->name }}</h1>
            <div class="flex-1"></div>
        </div>
    </div>

    @if($articles->count())
    <div class="space-y-6">
        @foreach($articles as $article)
        <article class="flex gap-4 pb-6 border-b border-gray-100 dark:border-gray-800 group hover:-translate-y-0.5 transition-all duration-200">
            <a href="{{ route('frontend.article', $article->slug) }}" class="w-32 h-20 md:w-48 md:h-28 bg-vnn-dark rounded overflow-hidden shrink-0 flex items-center justify-center">
                @if($article->featured_image)
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                <span class="text-white/20 font-extrabold text-2xl">G</span>
                @endif
            </a>
            <div class="flex-1">
                <a href="{{ route('frontend.article', $article->slug) }}">
                    <h2 class="text-lg font-bold leading-snug hover:text-vnn-red transition font-heading">{{ $article->title }}</h2>
                </a>
                @if($article->excerpt)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">{{ $article->excerpt }}</p>
                @endif
                <div class="flex items-center gap-2 mt-2 text-xs text-gray-400 dark:text-gray-500 font-body">
                    @if($article->category)
                    <a href="{{ route('frontend.category', $article->category->slug) }}" class="text-vnn-red font-semibold hover:underline">{{ $article->category->name }}</a>
                    <span>•</span>
                    @endif
                    <span>{{ $article->publication_date?->diffForHumans() ?? $article->created_at->diffForHumans() }}</span>
                    <span>•</span>
                    <span>{{ $article->reading_time }} min read</span>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
    @else
    <div class="text-center py-16">
        <p class="text-gray-400 dark:text-gray-500 text-lg font-body">No articles found with this tag.</p>
    </div>
    @endif
</section>
@endsection