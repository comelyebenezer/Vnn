<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Roles</h2>
            <a href="{{ route('admin.roles.create') }}" class="bg-vnn-red text-white text-sm font-bold px-4 py-2 rounded hover:bg-vnn-red-dark transition">+ New Role</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-sm rounded">{{ session('message') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input wire:model.live="search" type="text" placeholder="Search roles..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div></div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $roles->firstItem() }}-{{ $roles->lastItem() }} of {{ $roles->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th wire:click="sortBy('name')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Name</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Guard</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Permissions</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Users</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($roles as $role)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.roles.edit', $role) }}" class="font-medium text-vnn-blue hover:text-vnn-red transition">{{ $role->name }}</a>
                            </td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell text-xs">{{ $role->guard_name }}</td>
                            <td class="px-4 py-3 hidden md:table-cell">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-blue-100 text-blue-700">{{ $role->permissions_count }}</span>
                            </td>
                            <td class="px-4 py-3 hidden md:table-cell">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-gray-100 text-gray-700">{{ $role->users_count }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                    <button wire:click="deleteRole({{ $role->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this role?')">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-gray-400">No roles found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $roles->links() }}</div>
        </div>
    </div>
</div>
