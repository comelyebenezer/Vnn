<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $editMode ? 'Edit Advertisement' : 'Create Advertisement' }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $editMode ? 'Update this advertisement' : 'Add a new advertisement' }}</p>
            </div>
            <a href="{{ route('admin.advertisements.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-vnn-red transition flex items-center gap-1">
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
                        <input wire:model="title" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="e.g. Homepage Banner Ad">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                            <select wire:model="type" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                                <option value="banner">Banner</option>
                                <option value="sidebar">Sidebar</option>
                                <option value="inline">Inline</option>
                                <option value="popup">Popup</option>
                            </select>
                            @error('type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Placement</label>
                            <input wire:model="placement" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="e.g. header, sidebar, footer">
                            @error('placement') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Media Upload --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload Media (Image or Video)</label>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mb-2">Supports: JPG, PNG, GIF, WebP, MP4, WebM, OGG — Max 50MB</p>

                        @if($existing_media && !$media_file)
                        <div class="relative mb-3">
                            @if(\App\Models\Advertisement::find($advertisementId)?->media_type === 'video')
                            <video src="{{ asset('files/' . $existing_media) }}" class="w-full max-h-48 object-cover rounded-lg border border-gray-200 dark:border-gray-700" controls></video>
                            @else
                            <img src="{{ asset('files/' . $existing_media) }}" class="w-full max-h-48 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                            @endif
                            <button type="button" wire:click="$set('existing_media', null)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                        @endif

                        @if($media_file)
                        <div class="relative mb-3">
                            @php
                                $fileMime = $media_file->getMimeType();
                                $fileExt = strtolower($media_file->getClientOriginalExtension());
                                $isVideo = str_starts_with($fileMime ?? '', 'video/') || in_array($fileExt, ['mp4','webm','ogg','ogv','mov']);
                            @endphp
                            @if($isVideo)
                            <video src="{{ $media_file->temporaryUrl() }}" class="w-full max-h-48 object-cover rounded-lg border border-gray-200 dark:border-gray-700" controls></video>
                            @else
                            <img src="{{ $media_file->temporaryUrl() }}" class="w-full max-h-48 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                            @endif
                            <button type="button" wire:click="$set('media_file', null)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                        @endif

                        {{-- Upload Progress --}}
                        <div wire:loading wire:target="media_file" class="mb-3">
                            <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                                <div class="flex items-center gap-3">
                                    <svg class="animate-spin w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                    <span class="text-sm text-blue-700 dark:text-blue-300">Uploading file...</span>
                                </div>
                            </div>
                        </div>

                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-vnn-red transition cursor-pointer" onclick="document.getElementById('media-input').click()">
                            <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Click to upload image or video</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">JPG, PNG, GIF, WebP, MP4, WebM — Max 50MB</p>
                            <input id="media-input" wire:model="media_file" type="file" accept="image/*,video/*" class="hidden">
                        </div>
                        @error('media_file') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image URL <span class="text-gray-400 font-normal">(optional, fallback)</span></label>
                        <input wire:model="image_url" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="https://example.com/ad.jpg">
                        @error('image_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Script Code <span class="text-gray-400 font-normal">(for ad networks)</span></label>
                        <textarea wire:model="script_code" rows="4" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm font-mono focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="&lt;script&gt;...&lt;/script&gt;"></textarea>
                        @error('script_code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Link URL</label>
                        <input wire:model="link" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="https://example.com">
                        @error('link') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                            <input wire:model="start_date" type="date" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            @error('start_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date</label>
                            <input wire:model="end_date" type="date" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            @error('end_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                        <select wire:model="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded-lg text-sm hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                        {{ $editMode ? 'Update Advertisement' : 'Create Advertisement' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
