@extends('layouts.frontend')

@section('title', 'Podcasts')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center gap-3 mb-8 border-b-2 border-vnn-red pb-4">
        <h1 class="text-xl md:text-2xl font-extrabold text-vnn-dark dark:text-white font-heading uppercase">Podcasts</h1>
    </div>
    <div class="space-y-4">
        @forelse($podcasts as $podcast)
        @php $hasAudio = $podcast->audio_file || $podcast->audio_url; @endphp
        <div x-data="{ playing: false }" class="bg-white dark:bg-vnn-dark-light rounded-lg shadow-sm overflow-hidden hover:bg-vnn-gray dark:hover:bg-vnn-dark transition group hover:-translate-y-0.5 duration-200">
            <div class="flex items-center gap-3 md:gap-4 p-4">
                @if($podcast->cover_image)
                <div class="w-12 h-12 md:w-16 md:h-16 rounded shrink-0 overflow-hidden cursor-pointer" @click="if({{ $hasAudio ? 'true' : 'false' }}) playing = !playing">
                    <img src="{{ str_starts_with($podcast->cover_image, 'http') ? $podcast->cover_image : asset('storage/' . $podcast->cover_image) }}" alt="{{ $podcast->title }}" class="w-full h-full object-cover">
                </div>
                @else
                <div class="w-12 h-12 md:w-16 md:h-16 bg-vnn-red rounded flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform cursor-pointer" @click="if({{ $hasAudio ? 'true' : 'false' }}) playing = !playing">
                    <svg x-show="!playing" class="w-5 h-5 md:w-7 md:h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
                    <svg x-show="playing" x-cloak class="w-5 h-5 md:w-7 md:h-7 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                </div>
                @endif
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm md:text-base font-bold text-gray-900 dark:text-white group-hover:text-vnn-red transition font-heading truncate">{{ $podcast->title }}</h3>
                    @if($podcast->description)
                    <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-1 font-body">{{ $podcast->description }}</p>
                    @endif
                    <span class="text-xs text-gray-400 dark:text-gray-500 font-body">
                        @if($podcast->episode_number)Ep {{ $podcast->episode_number }}@if($podcast->season_number) • Season {{ $podcast->season_number }}@endif • @endif{{ $podcast->created_at->diffForHumans() }}
                    </span>
                </div>
                @if($hasAudio)
                <button @click="playing = !playing" class="shrink-0 text-gray-400 hover:text-vnn-red transition" :title="playing ? 'Pause' : 'Play'">
                    <svg x-show="!playing" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <svg x-show="playing" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6"/></svg>
                </button>
                @endif
            </div>
            @if($hasAudio)
            <div x-show="playing" x-cloak class="px-4 pb-4 -mt-2">
                <audio x-init="$watch('playing', v => { if(v) $el.play(); else { $el.pause(); $el.currentTime = 0; } })" src="{{ $podcast->audio_file ? asset('storage/' . $podcast->audio_file) : $podcast->audio_url }}" controls class="w-full h-10"></audio>
            </div>
            @endif
        </div>
        @empty
        <p class="text-gray-400 dark:text-gray-500 text-sm font-body">No podcasts published yet.</p>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $podcasts->links() }}
    </div>
</div>
@endsection
