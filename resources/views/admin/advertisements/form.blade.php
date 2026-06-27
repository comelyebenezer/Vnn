<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit Advertisement' : 'Create Advertisement' }}</h2>
            <a href="{{ route('admin.advertisements.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Advertisements</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                        <input wire:model="title" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-vnn-blue" placeholder="e.g. Homepage Banner Ad">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Type</label>
                            <select wire:model="type" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="banner">Banner</option>
                                <option value="sidebar">Sidebar</option>
                                <option value="inline">Inline</option>
                                <option value="popup">Popup</option>
                            </select>
                            @error('type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Placement</label>
                            <input wire:model="placement" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. header, sidebar, footer">
                            @error('placement') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Image URL</label>
                        <input wire:model="image_url" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://example.com/ad.jpg">
                        @error('image_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Script Code</label>
                        <textarea wire:model="script_code" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 text-sm font-mono focus:outline-none focus:border-vnn-blue" placeholder="&lt;script&gt;...&lt;/script&gt;"></textarea>
                        @error('script_code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Link URL</label>
                        <input wire:model="link" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://example.com">
                        @error('link') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Start Date</label>
                            <input wire:model="start_date" type="date" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            @error('start_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">End Date</label>
                            <input wire:model="end_date" type="date" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            @error('end_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                        <select wire:model="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded text-sm hover:bg-vnn-red-dark transition">
                        {{ $editMode ? 'Update Advertisement' : 'Create Advertisement' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
