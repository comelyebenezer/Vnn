<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $editMode ? 'Edit Podcast' : 'Create Podcast' }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $editMode ? 'Update this podcast episode' : 'Add a new podcast episode' }}</p>
            </div>
            <a href="{{ route('admin.podcasts.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-vnn-red transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 lg:px-6">
        <div class="max-w-3xl mx-auto">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                        <input wire:model="title" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="e.g. Episode 1: The Future of Tech">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Slug</label>
                        <input wire:model="slug" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="episode-1-the-future-of-tech">
                        @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <textarea wire:model="description" rows="4" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Podcast description..."></textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Audio Section --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Audio</label>

                        {{-- Existing uploaded file --}}
                        @if($existingAudioFile && !$removeAudioFile)
                        <div class="mb-3 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
                                    <span class="text-sm text-green-700 dark:text-green-300 font-medium">Audio file uploaded</span>
                                </div>
                                <button type="button" wire:click="removeExistingAudio" class="text-red-500 hover:text-red-700 text-xs font-semibold">Remove</button>
                            </div>
                            <audio controls class="w-full mt-2 h-8" style="height: 32px;">
                                <source src="{{ asset('storage/' . $existingAudioFile) }}">
                            </audio>
                        </div>
                        @endif

                        {{-- Upload area --}}
                        @if(!$existingAudioFile || $removeAudioFile)
                        <div class="relative" x-data="{ uploading: false, progress: 0 }"
                             x-on:livewire-upload-start="uploading = true"
                             x-on:livewire-upload-finish="uploading = false; progress = 0"
                             x-on:livewire-upload-error="uploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-vnn-red dark:hover:border-vnn-red transition cursor-pointer"
                                 x-on:click="$refs.audioInput.click()"
                                 x-on:dragover.prevent="true"
                                 x-on:drop.prevent="$refs.audioInput.files = $event.dataTransfer.files; $refs.audioInput.dispatchEvent(new Event('change'))">
                                <div x-show="!uploading">
                                    <svg class="w-10 h-10 mx-auto text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><span class="font-semibold text-vnn-red">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500">MP3, MPEG, OGG, WAV, WebM, AAC (max 100MB)</p>
                                </div>
                                <div x-show="uploading" class="py-2">
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                                        <div class="bg-vnn-red h-2 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Uploading... <span x-text="progress + '%'"></span></p>
                                </div>
                            </div>
                            <input wire:model="audio_file" type="file" x-ref="audioInput" accept=".mp3,.mpeg,.ogg,.wav,.webm,.aac" class="hidden">
                        </div>
                        @error('audio_file') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Or enter Audio URL</label>
                        <input wire:model="audio_url" type="url" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="https://example.com/episode.mp3" {{ $existingAudioFile && !$removeAudioFile ? 'disabled' : '' }}>
                        @error('audio_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        @if($existingAudioFile && !$removeAudioFile)
                        <p class="text-xs text-gray-400 mt-1">Remove the uploaded file first to use a URL instead.</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cover Image</label>

                            {{-- Existing cover image --}}
                            @if($existing_cover_image && !$remove_cover_image)
                            <div class="mb-3 relative group">
                                <img src="{{ str_starts_with($existing_cover_image, 'http') ? $existing_cover_image : asset('storage/' . $existing_cover_image) }}" alt="Cover" class="w-full h-40 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                                <button type="button" wire:click="removeExistingCoverImage" class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-lg hover:bg-red-600 transition shadow opacity-0 group-hover:opacity-100">Remove</button>
                            </div>
                            @endif

                            {{-- Upload area --}}
                            @if(!$existing_cover_image || $remove_cover_image)
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 text-center hover:border-vnn-red dark:hover:border-vnn-red transition cursor-pointer"
                                 x-on:click="$refs.coverInput.click()">
                                @if($cover_image_file)
                                <div class="relative">
                                    <img src="{{ $cover_image_file->temporaryUrl() }}" alt="Preview" class="w-full h-40 object-cover rounded-lg">
                                    <button type="button" x-on:click.stop="$wire.set('cover_image_file', null)" class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-lg hover:bg-red-600 transition shadow">Remove</button>
                                </div>
                                @else
                                <svg class="w-8 h-8 mx-auto text-gray-400 dark:text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-xs text-gray-500"><span class="font-semibold text-vnn-red">Click to upload</span> cover image</p>
                                <p class="text-[10px] text-gray-400 mt-1">JPG, PNG, WebP (max 2MB)</p>
                                @endif
                            </div>
                            <input wire:model="cover_image_file" type="file" x-ref="coverInput" accept="image/*" class="hidden">
                            @error('cover_image_file') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                            <div class="mt-2">
                                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Or enter image URL</label>
                                <input wire:model="cover_image" type="url" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="https://example.com/image.jpg" {{ $cover_image_file ? 'disabled' : '' }}>
                                @error('cover_image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                @if($cover_image_file)
                                <p class="text-[10px] text-gray-400 mt-1">Remove the uploaded file first to use a URL instead.</p>
                                @endif
                            </div>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration (seconds)</label>
                            <input wire:model="duration" type="number" min="0" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="e.g. 1800">
                            @error('duration') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Season Number</label>
                            <input wire:model="season_number" type="number" min="1" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="e.g. 1">
                            @error('season_number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Episode Number</label>
                            <input wire:model="episode_number" type="number" min="1" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="e.g. 1">
                            @error('episode_number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                            <select wire:model="category_id" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select wire:model="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded-lg text-sm hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                        {{ $editMode ? 'Update Podcast' : 'Create Podcast' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
