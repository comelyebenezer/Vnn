<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit Author' : 'Create Author' }}</h2>
            <a href="{{ route('admin.authors.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Authors</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">User</label>
                        <select wire:model="user_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Bio</label>
                        <textarea wire:model="bio" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Author bio..."></textarea>
                        @error('bio') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Expertise</label>
                        <input wire:model="expertise" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. Political Analysis, Tech">
                        @error('expertise') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Facebook URL</label>
                            <input wire:model="facebook_url" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://facebook.com/...">
                            @error('facebook_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Twitter URL</label>
                            <input wire:model="twitter_url" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://twitter.com/...">
                            @error('twitter_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Instagram URL</label>
                            <input wire:model="instagram_url" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://instagram.com/...">
                            @error('instagram_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">LinkedIn URL</label>
                            <input wire:model="linkedin_url" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://linkedin.com/...">
                            @error('linkedin_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Website URL</label>
                        <input wire:model="website_url" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="https://...">
                        @error('website_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2">
                            <input wire:model="is_featured" type="checkbox" class="rounded border-gray-300 text-vnn-red focus:ring-vnn-red">
                            <span class="text-sm font-semibold text-gray-700">Featured Author</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded text-sm hover:bg-vnn-red-dark transition">
                        {{ $editMode ? 'Update Author' : 'Create Author' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
