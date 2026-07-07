<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $editMode ? 'Edit' : 'Create' }} Ticker Item</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Add scrolling text for the news ticker</p>
            </div>
            <a href="{{ route('admin.ticker.index') }}" class="text-sm text-gray-500 hover:text-vnn-red transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 lg:px-6">
        <div class="max-w-2xl mx-auto">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ticker Text</label>
                        <input wire:model="text" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Breaking news headline...">
                        @error('text') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Icon / Emoji</label>
                            <input wire:model="icon" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-4 py-3 text-lg focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="🔴">
                            <p class="text-xs text-gray-400 mt-1">e.g. 🔴 📰 ⚽ 📊 🌍 💰 🔥</p>
                            @error('icon') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort Order</label>
                            <input wire:model="sort_order" type="number" min="0" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            @error('sort_order') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input wire:model="is_active" type="checkbox" class="rounded text-vnn-red focus:ring-vnn-red dark:bg-gray-700 dark:border-gray-600">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Active (visible on frontend)</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded-lg text-sm hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                        {{ $editMode ? 'Update Ticker' : 'Create Ticker' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
