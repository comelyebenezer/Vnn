<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit User' : 'Create User' }}</h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Users</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                            <input wire:model="name" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Full name">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                            <input wire:model="email" type="email" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-vnn-blue" placeholder="user@example.com">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                            <input wire:model="password" type="password" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="{{ $editMode ? 'Leave blank to keep' : 'Password' }}">
                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
                            <input wire:model="password_confirmation" type="password" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Confirm password">
                            @error('password_confirmation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Designation</label>
                            <input wire:model="designation" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. Senior Editor">
                            @error('designation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                            <input wire:model="phone" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. +880 1XXX XXXXXXX">
                            @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Bio</label>
                        <textarea wire:model="bio" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Short bio..."></textarea>
                        @error('bio') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Avatar</label>
                        <input wire:model="avatar" type="file" accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        @error('avatar') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        @if($avatar)
                        <div class="mt-2 border rounded-lg p-2 bg-gray-50 inline-block">
                            <img src="{{ $avatar->temporaryUrl() }}" class="h-20 w-20 rounded-full object-cover">
                        </div>
                        @elseif($existingAvatar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $existingAvatar) }}" class="h-20 w-20 rounded-full object-cover">
                        </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                        <select wire:model="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Roles</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @forelse($roles as $role)
                            <label class="inline-flex items-center gap-2">
                                <input wire:model="selectedRoles" type="checkbox" value="{{ $role->id }}" class="rounded border-gray-300 text-vnn-red focus:ring-vnn-red">
                                <span class="text-sm text-gray-700">{{ $role->name }}</span>
                            </label>
                            @empty
                            <p class="text-sm text-gray-400">No roles available.</p>
                            @endforelse
                        </div>
                        @error('selectedRoles') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded text-sm hover:bg-vnn-red-dark transition">
                        {{ $editMode ? 'Update User' : 'Create User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
