<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Users</h2>
            <a href="{{ route('admin.users.create') }}" class="bg-vnn-red text-white text-sm font-bold px-4 py-2 rounded hover:bg-vnn-red-dark transition">+ New User</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-sm rounded">{{ session('message') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input wire:model.live="search" type="text" placeholder="Search by name or email..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div></div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $users->firstItem() }}-{{ $users->lastItem() }} of {{ $users->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th wire:click="sortBy('name')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Name</th>
                            <th wire:click="sortBy('email')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue hidden md:table-cell">Email</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Designation</th>
                            <th wire:click="sortBy('status')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Roles</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-8 h-8 rounded-full object-cover">
                                    @else
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold text-gray-500">{{ substr($user->name, 0, 2) }}</div>
                                    @endif
                                    <a href="{{ route('admin.users.edit', $user) }}" class="font-medium text-vnn-blue hover:text-vnn-red transition">{{ $user->name }}</a>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell text-xs">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell text-xs">{{ $user->designation ?: 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $user->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 hidden md:table-cell">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($user->roles as $role)
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-vnn-blue/10 text-vnn-blue">{{ $role->name }}</span>
                                    @empty
                                    <span class="text-xs text-gray-400">—</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                    <button wire:click="deleteUser({{ $user->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this user?')">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-gray-400">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $users->links() }}</div>
        </div>
    </div>
</div>
