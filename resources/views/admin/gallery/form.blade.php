<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $editMode ? 'Edit Gallery Image' : 'Add Gallery Image' }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $editMode ? 'Update this gallery image' : 'Upload a new gallery image' }}</p>
            </div>
            <a href="{{ route('admin.gallery.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-vnn-red transition flex items-center gap-1">
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
                        <input wire:model="title" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="e.g. Newsroom event">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image</label>
                        @if($existingImage && !$image)
                        <div class="mb-3 relative">
                            <img src="{{ asset('storage/' . $existingImage) }}" class="w-full h-48 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                        </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-vnn-red dark:hover:border-vnn-red transition cursor-pointer"
                             x-data="{ uploading: false, progress: 0 }"
                             x-on:livewire-upload-start="uploading = true"
                             x-on:livewire-upload-finish="uploading = false; progress = 0"
                             x-on:livewire-upload-error="uploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div x-show="!uploading" x-on:click="$refs.imageInput.click()">
                                <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Click to upload image</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">JPG, PNG, GIF, WebP (max 2MB)</p>
                            </div>
                            <div x-show="uploading" class="py-2">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                                    <div class="bg-vnn-red h-2 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
                                </div>
                                <p class="text-sm text-gray-500">Uploading... <span x-text="progress + '%'"></span></p>
                            </div>
                        </div>
                        <input wire:model="image" type="file" x-ref="imageInput" accept="image/*" class="hidden">
                        @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label>
                        <input wire:model="caption" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Optional caption">
                        @error('caption') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select wire:model="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort Order</label>
                            <input wire:model="sort_order" type="number" min="0" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="0">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded-lg text-sm hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                        {{ $editMode ? 'Update Image' : 'Upload Image' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
