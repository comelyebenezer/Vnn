<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $editMode ? 'Edit Live Video' : 'Create Live Video' }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $editMode ? 'Update the live video details below' : 'Add a new live video stream' }}</p>
            </div>
            <a href="{{ route('admin.live.index') }}" class="flex items-center gap-2 text-sm text-gray-500 hover:text-vnn-red transition px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Live Videos
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 lg:px-6">
        <div class="max-w-4xl mx-auto">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Title</label>
                        <input wire:model="title" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-4 py-3 text-lg font-bold text-gray-900 dark:text-white focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Live stream title...">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Description</label>
                        <textarea wire:model="description" rows="4" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Brief description of the live stream..."></textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Video URL</label>
                            <input wire:model="video_url" type="url" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="https://youtube.com/watch?v=...">
                            @error('video_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Video Type</label>
                            <select wire:model="video_type" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red">
                                <option value="youtube">YouTube</option>
                                <option value="facebook">Facebook</option>
                                <option value="vimeo">Vimeo</option>
                                <option value="other">Other</option>
                            </select>
                            @error('video_type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <input wire:model="is_live" type="checkbox" id="is_live" class="rounded text-vnn-red focus:ring-vnn-red dark:bg-gray-700 dark:border-gray-600" {{ $is_live ? 'checked' : '' }}>
                            <label for="is_live" class="text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">Mark as Live Now</label>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Status</label>
                            <select wire:model="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded-lg text-sm hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                        {{ $editMode ? 'Update Live Video' : 'Create Live Video' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
