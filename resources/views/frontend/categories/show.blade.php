@extends('layouts.frontend')

@section('title', $category?->name ?? 'Category')
@section('meta_description', $category?->description ?? '')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-8">
    @if($category)
    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-2 font-body">
            <a href="/" class="hover:text-vnn-red">Home</a>
            <span>/</span>
            <span class="text-gray-400 dark:text-gray-500">{{ $category->name }}</span>
        </div>
        <div class="flex items-center gap-4 border-b-2 border-vnn-red pb-2">
            <h1 class="text-3xl font-extrabold text-vnn-dark dark:text-white font-heading">{{ $category->name }}</h1>
            <div class="flex-1"></div>
        </div>
        @if($category->description)
        <p class="text-gray-500 dark:text-gray-400 mt-2 font-body">{{ $category->description }}</p>
        @endif
    </div>
    @endif

    {{-- Articles Grid --}}
    @if($articles->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($articles as $article)
        <article class="group bg-white dark:bg-vnn-dark-light rounded shadow-sm overflow-hidden hover:shadow-md transition-shadow">
            <a href="{{ route('frontend.article', $article->slug) }}">
                <div class="aspect-[16/10] bg-vnn-dark overflow-hidden flex items-center justify-center">
                    @if($article->featured_image)
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                    <span class="text-white/20 font-extrabold text-4xl">G</span>
                    @endif
                </div>
            </a>
            <div class="p-4">
                @if($article->category)
                <a href="{{ route('frontend.category', $article->category->slug) }}" class="text-vnn-red text-xs font-bold uppercase tracking-wide hover:underline">{{ $article->category->name }}</a>
                @endif
                <a href="{{ route('frontend.article', $article->slug) }}">
                    <h2 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">{{ $article->title }}</h2>
                </a>
                @if($article->excerpt)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">{{ $article->excerpt }}</p>
                @endif
                <div class="flex items-center gap-2 mt-2 text-xs text-gray-400 dark:text-gray-500 font-body">
                    @if($article->author)
                    <span>By {{ $article->author->name }}</span>
                    <span>•</span>
                    @endif
                    <span>{{ $article->publication_date?->diffForHumans() ?? $article->created_at->diffForHumans() }}</span>
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
        <p class="text-gray-400 dark:text-gray-500 text-lg font-body">No articles found in this category.</p>
    </div>
    @endif
</section>
@endsection