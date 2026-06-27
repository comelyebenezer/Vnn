@extends('layouts.frontend')

@section('title', 'Podcasts')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center gap-3 mb-8 border-b-2 border-vnn-red pb-4">
        <h1 class="text-xl md:text-2xl font-extrabold text-vnn-dark dark:text-white font-heading uppercase">Podcasts</h1>
    </div>
    <div class="space-y-4">
        @forelse($podcasts as $podcast)
        <a href="{{ route('frontend.article', $podcast->slug) }}" class="flex items-center gap-3 md:gap-4 p-4 bg-white dark:bg-vnn-dark-light rounded-lg shadow-sm hover:bg-vnn-gray dark:hover:bg-vnn-dark transition group hover:-translate-y-0.5 duration-200">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-vnn-red rounded flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                <svg class="w-5 h-5 md:w-7 md:h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-sm md:text-base font-bold group-hover:text-vnn-red transition font-heading truncate">{{ $podcast->title }}</h3>
                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-1 font-body">{{ $podcast->excerpt }}</p>
                <span class="text-xs text-gray-400 font-body">{{ $podcast->publication_date?->diffForHumans() ?? $podcast->created_at->diffForHumans() }}</span>
            </div>
            <span class="hidden sm:inline text-sm text-vnn-red font-semibold group-hover:translate-x-0.5 transition-transform shrink-0">Listen →</span>
        </a>
        @empty
        <p class="text-gray-400 text-sm font-body">No podcasts published yet.</p>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $podcasts->links() }}
    </div>
</div>
@endsection
