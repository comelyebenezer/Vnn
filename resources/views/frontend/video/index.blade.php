@extends('layouts.frontend')

@section('title', 'Videos')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center gap-3 mb-8 border-b-2 border-vnn-red pb-4">
        <h1 class="text-xl md:text-2xl font-extrabold text-vnn-dark dark:text-white font-heading uppercase">Videos</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($videos as $video)
        @php $hasVideo = $video->youtube_id || $video->video_file || $video->embed_code; @endphp
        <div x-data="{ playing: false }" class="group block bg-white dark:bg-vnn-dark-light rounded-lg shadow-sm overflow-hidden hover:-translate-y-1 transition-all duration-200">
            <div class="aspect-video overflow-hidden relative bg-black">
                <template x-if="playing">
                    @if($video->youtube_id)
                    <iframe src="https://www.youtube.com/embed/{{ $video->youtube_id }}?autoplay=1&rel=0" class="absolute inset-0 w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @elseif($video->video_file)
                    <video src="{{ asset('storage/' . $video->video_file) }}" controls autoplay class="absolute inset-0 w-full h-full object-cover"></video>
                    @elseif($video->embed_code)
                    <div class="absolute inset-0 w-full h-full">{!! $video->embed_code !!}</div>
                    @endif
                </template>
                <template x-if="!playing">
                    <div class="absolute inset-0" @click="if({{ $hasVideo ? 'true' : 'false' }}) playing = true">
                        @if($video->thumbnail)
                        <img src="{{ str_starts_with($video->thumbnail, 'http') ? $video->thumbnail : asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-vnn-red to-vnn-red-dark flex items-center justify-center">
                            <span class="text-white/15 font-extrabold text-3xl">V</span>
                        </div>
                        @endif
                        @if($hasVideo)
                        <div class="absolute inset-0 flex items-center justify-center cursor-pointer">
                            <div class="w-12 h-12 bg-vnn-red/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                        </div>
                        @endif
                    </div>
                </template>
            </div>
            <div class="p-4 flex items-start justify-between">
                <div class="min-w-0 flex-1">
                    <h3 class="font-bold text-sm leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $video->title }}</h3>
                    <span class="text-xs text-gray-400 dark:text-gray-500 mt-2 block font-body">{{ $video->created_at->diffForHumans() }}</span>
                </div>
                @if($hasVideo)
                <button @click="playing = !playing" class="shrink-0 ml-2 text-gray-400 hover:text-vnn-red transition" :title="playing ? 'Close' : 'Play'">
                    <svg x-show="!playing" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <svg x-show="playing" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                @endif
            </div>
        </div>
        @empty
        <p class="text-gray-400 dark:text-gray-500 col-span-full text-sm font-body">No videos published yet.</p>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $videos->links() }}
    </div>
</div>
@endsection
