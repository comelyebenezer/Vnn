@extends('layouts.frontend')

@section('title', $live->title)

@section('content')
<article class="max-w-4xl mx-auto px-4 py-8">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-6 font-body">
        <a href="/" class="hover:text-vnn-red">Home</a>
        <span>/</span>
        <a href="/" class="hover:text-vnn-red">Live Updates</a>
        <span>/</span>
        <span class="text-gray-400 dark:text-gray-500 truncate">{{ $live->title }}</span>
    </div>

    {{-- Title --}}
    <h1 class="text-3xl md:text-4xl font-extrabold leading-tight text-vnn-dark dark:text-white font-heading">{{ $live->title }}</h1>

    {{-- Meta --}}
    <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 pb-4 font-body">
        <span>VNN</span>
        <span>|</span>
        <span>{{ $live->created_at->format('M d, Y') }}</span>
        @if($live->is_live)
        <span class="inline-flex items-center gap-1 bg-vnn-red text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">
            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
            Live
        </span>
        @endif
    </div>

    {{-- Media --}}
    <div class="mt-6">
        @if($live->media_type === 'image' && $live->image_file)
            <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <img src="{{ asset('storage/' . $live->image_file) }}" alt="{{ $live->title }}" class="w-full object-cover">
            </div>
        @elseif($live->video_type === 'youtube')
            <div class="aspect-video rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <iframe src="{{ $live->embed_url }}" class="w-full h-full" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
        @elseif($live->video_type === 'facebook')
            <div class="aspect-video rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <iframe src="{{ $live->embed_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
            </div>
        @elseif($live->video_file)
            <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <video class="w-full" controls playsinline>
                    <source src="{{ asset('storage/' . $live->video_file) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif
    </div>

    {{-- Description --}}
    @if($live->description)
    <div class="mt-6 text-gray-700 dark:text-gray-300 leading-relaxed font-body text-base">
        {!! nl2br(e($live->description)) !!}
    </div>
    @endif

    {{-- Back --}}
    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <a href="/" class="text-vnn-red hover:underline text-sm font-semibold">&larr; Back to Live Updates</a>
    </div>
</article>
@endsection
