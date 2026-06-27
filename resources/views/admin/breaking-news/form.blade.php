<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit Breaking News' : 'Create Breaking News' }}</h2>
            <a href="{{ route('admin.breaking-news.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Breaking News</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                        <input wire:model="title" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Breaking news title...">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Content</label>
                        <textarea wire:model="content" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Optional short description..."></textarea>
                        @error('content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Linked Article</label>
                        <select wire:model="article_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="">None</option>
                            @foreach($articles as $article)
                            <option value="{{ $article->id }}">{{ $article->title }}</option>
                            @endforeach
                        </select>
                        @error('article_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                            <select wire:model="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Priority (1-10)</label>
                            <input wire:model="priority" type="number" min="1" max="10" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            @error('priority') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Expires At</label>
                            <input wire:model="expires_at" type="datetime-local" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            @error('expires_at') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded text-sm hover:bg-vnn-red-dark transition">
                        {{ $editMode ? 'Update Breaking News' : 'Create Breaking News' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
