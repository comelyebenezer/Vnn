<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">Upload Media</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Upload a new media file</p>
            </div>
            <a href="{{ route('admin.media.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-vnn-red transition flex items-center gap-1">
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
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">File</label>
                        <input wire:model="upload" type="file" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                        @error('upload') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    @if($upload)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-800/50">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preview</p>
                        @if(str_starts_with($upload->getMimeType(), 'image'))
                        <img src="{{ $upload->temporaryUrl() }}" class="max-h-64 rounded">
                        @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $upload->getClientOriginalName() }} ({{ number_format($upload->getSize() / 1024, 1) }} KB)</p>
                        @endif
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alt Text</label>
                        <input wire:model="alt_text" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Describe the image for accessibility">
                        @error('alt_text') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label>
                        <textarea wire:model="caption" rows="2" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Optional caption..."></textarea>
                        @error('caption') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded-lg text-sm hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">Upload Media</button>
                </div>
            </form>
        </div>
    </div>
</div>
