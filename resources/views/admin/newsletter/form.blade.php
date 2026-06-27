<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit Newsletter' : 'Create Newsletter' }}</h2>
            <a href="{{ route('admin.newsletter.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Newsletters</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Subject</label>
                        <input wire:model="subject" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-vnn-blue" placeholder="e.g. Weekly News Roundup">
                        @error('subject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Content</label>
                        <textarea wire:model="content" rows="12" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Newsletter content..."></textarea>
                        @error('content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                        <select wire:model="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="draft">Draft</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="sent">Sent</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded text-sm hover:bg-vnn-red-dark transition">
                        {{ $editMode ? 'Update Newsletter' : 'Create Newsletter' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
