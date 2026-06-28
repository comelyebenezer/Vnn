@extends('layouts.frontend')

@section('title', $author->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Author Header --}}
    <div class="bg-white dark:bg-vnn-dark-light rounded-lg p-6 md:p-8 shadow-sm mb-8">
        <div class="flex flex-col md:flex-row items-center gap-4 md:gap-6">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-vnn-red rounded-full flex items-center justify-center shrink-0">
                @if($author->avatar)
                <img src="{{ asset('storage/' . $author->avatar) }}" alt="{{ $author->name }}" class="w-full h-full rounded-full object-cover">
                @else
                <span class="text-white font-extrabold text-2xl md:text-3xl">{{ strtoupper(substr($author->name, 0, 1)) }}</span>
                @endif
            </div>
            <div class="text-center md:text-left">
                <h1 class="text-xl md:text-2xl font-extrabold text-vnn-dark dark:text-white font-heading">{{ $author->name }}</h1>
                @if($author->designation)
                <p class="text-vnn-red font-semibold text-sm">{{ $author->designation }}</p>
                @endif
                @if($author->bio)
                <p class="text-gray-600 dark:text-gray-300 text-sm mt-2 max-w-2xl font-body">{{ $author->bio }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Articles --}}
    <h2 class="text-xl font-extrabold text-vnn-dark dark:text-white mb-6 font-heading">Articles by {{ $author->name }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $article)
        <a href="{{ route('frontend.article', $article->slug) }}" class="group block bg-white dark:bg-vnn-dark-light rounded-lg shadow-sm overflow-hidden hover:-translate-y-1 transition-all duration-200">
            @if($article->featured_image)
            <div class="aspect-video overflow-hidden">
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            @else
            <div class="aspect-video bg-gradient-to-br from-vnn-red/80 to-vnn-dark flex items-center justify-center">
                <span class="text-white/20 font-extrabold text-5xl font-heading">V</span>
            </div>
            @endif
            <div class="p-4">
                <h3 class="font-bold text-sm leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $article->title }}</h3>
                <span class="text-xs text-gray-400 dark:text-gray-500 mt-2 block font-body">{{ $article->publication_date?->diffForHumans() ?? $article->created_at->diffForHumans() }}</span>
            </div>
        </a>
        @empty
        <p class="text-gray-400 dark:text-gray-500 col-span-full text-sm font-body">No articles published yet.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</div>
@endsection
