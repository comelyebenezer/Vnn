@extends('layouts.frontend')

@section('title', 'Videos')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center gap-3 mb-8 border-b-2 border-vnn-red pb-4">
        <h1 class="text-xl md:text-2xl font-extrabold text-vnn-dark dark:text-white font-heading uppercase">Videos</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($videos as $video)
        <a href="{{ route('frontend.article', $video->slug) }}" class="group block bg-white dark:bg-vnn-dark-light rounded-lg shadow-sm overflow-hidden hover:-translate-y-1 transition-all duration-200">
            @if($video->featured_image)
            <div class="aspect-video overflow-hidden relative">
                <img src="{{ asset('storage/' . $video->featured_image) }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-12 h-12 bg-vnn-red/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                    </div>
                </div>
            </div>
            @else
            <div class="aspect-video bg-gradient-to-br from-vnn-red to-vnn-red-dark flex items-center justify-center relative">
                <span class="text-white/15 font-extrabold text-3xl">V</span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-12 h-12 bg-vnn-red/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                    </div>
                </div>
            </div>
            @endif
            <div class="p-4">
                <h3 class="font-bold text-sm leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $video->title }}</h3>
                <span class="text-xs text-gray-400 dark:text-gray-500 mt-2 block font-body">{{ $video->publication_date?->diffForHumans() ?? $video->created_at->diffForHumans() }}</span>
            </div>
        </a>
        @empty
        <p class="text-gray-400 dark:text-gray-500 col-span-full text-sm font-body">No videos published yet.</p>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $videos->links() }}
    </div>
</div>
@endsection
