<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit Podcast' : 'Create Podcast' }}</h2>
            <a href="{{ route('admin.podcasts.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Podcasts</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                        <input wire:model="title" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-vnn-blue" placeholder="e.g. Episode 1: The Future of Tech">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Slug</label>
                        <input wire:model="slug" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="episode-1-the-future-of-tech">
                        @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                        <textarea wire:model="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Podcast description..."></textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Audio URL</label>
                            <input wire:model="audio_url" type="url" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://...mp3">
                            @error('audio_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Cover Image URL</label>
                            <input wire:model="cover_image" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://...">
                            @error('cover_image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Duration (seconds)</label>
                            <input wire:model="duration" type="number" min="0" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. 1800">
                            @error('duration') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Season Number</label>
                            <input wire:model="season_number" type="number" min="1" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. 1">
                            @error('season_number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Episode Number</label>
                            <input wire:model="episode_number" type="number" min="1" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. 1">
                            @error('episode_number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                            <select wire:model="category_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                            <select wire:model="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded text-sm hover:bg-vnn-red-dark transition">
                        {{ $editMode ? 'Update Podcast' : 'Create Podcast' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
