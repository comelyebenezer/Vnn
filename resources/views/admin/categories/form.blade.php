<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit Category' : 'Create Category' }}</h2>
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Categories</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                        <input wire:model="name" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-vnn-blue" placeholder="e.g. Politics">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Slug</label>
                        <input wire:model="slug" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="politics">
                        @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                        <textarea wire:model="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Category description..."></textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Parent Category</label>
                            <select wire:model="parent_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="">None (Top Level)</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Display Order</label>
                            <input wire:model="display_order" type="number" min="0" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Icon (CSS class)</label>
                            <input wire:model="icon" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. fa-solid fa-newspaper">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Image URL</label>
                            <input wire:model="image" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://...">
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
                        {{ $editMode ? 'Update Category' : 'Create Category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
