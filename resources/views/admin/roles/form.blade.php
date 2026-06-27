<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $editMode ? 'Edit Role' : 'Create Role' }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $editMode ? 'Update this role' : 'Add a new user role' }}</p>
            </div>
            <a href="{{ route('admin.roles.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-vnn-red transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 lg:px-6">
        <div class="max-w-3xl mx-auto">
            <form wire:submit="save" class="space-y-6">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                            <input wire:model="name" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="e.g. editor">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Guard Name</label>
                            <select wire:model="guard_name" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                                <option value="web">Web</option>
                                <option value="api">API</option>
                            </select>
                            @error('guard_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Permissions</label>
                        @error('selectedPermissions') <span class="text-red-500 text-xs mt-1 block mb-2">{{ $message }}</span> @enderror

                        <div class="space-y-4">
                            @forelse($groupedPermissions as $group => $permissions)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <div class="flex items-center gap-2 mb-3">
                                    <input type="checkbox"
                                        wire:click="$toggle('selectAll_{{ Str::slug($group) }}')"
                                        {{ collect($selectedPermissions)->intersect($permissions->pluck('id')->map(fn($id) => (string) $id))->count() === $permissions->count() ? 'checked' : '' }}
                                        class="rounded border-gray-300 dark:border-gray-600 text-vnn-red focus:ring-vnn-red select-all-checkbox">
                                    <span class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{ str_replace('.*', '', $group) }}</span>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                    @foreach($permissions as $perm)
                                    <label class="inline-flex items-center gap-2">
                                        <input wire:model="selectedPermissions" type="checkbox" value="{{ $perm->id }}" class="rounded border-gray-300 dark:border-gray-600 text-vnn-red focus:ring-vnn-red">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $perm->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @empty
                            <p class="text-sm text-gray-400">No permissions found. Create permissions first.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded-lg text-sm hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                        {{ $editMode ? 'Update Role' : 'Create Role' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
