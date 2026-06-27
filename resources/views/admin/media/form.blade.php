<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Upload Media</h2>
            <a href="{{ route('admin.media.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Media Library</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">File</label>
                        <input wire:model="upload" type="file" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        @error('upload') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    @if($upload)
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <p class="text-sm font-medium text-gray-700 mb-2">Preview</p>
                        @if(str_starts_with($upload->getMimeType(), 'image'))
                        <img src="{{ $upload->temporaryUrl() }}" class="max-h-64 rounded">
                        @else
                        <p class="text-sm text-gray-500">{{ $upload->getClientOriginalName() }} ({{ number_format($upload->getSize() / 1024, 1) }} KB)</p>
                        @endif
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alt Text</label>
                        <input wire:model="alt_text" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Describe the image for accessibility">
                        @error('alt_text') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Caption</label>
                        <textarea wire:model="caption" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Optional caption..."></textarea>
                        @error('caption') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded text-sm hover:bg-vnn-red-dark transition">Upload Media</button>
                </div>
            </form>
        </div>
    </div>
</div>
