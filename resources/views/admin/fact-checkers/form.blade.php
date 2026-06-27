<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit Fact Checker' : 'Create Fact Checker' }}</h2>
            <a href="{{ route('admin.fact-checkers.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Fact Checkers</a>
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
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Specialization</label>
                        <input wire:model="specialization" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="e.g. Politics, Health, Science">
                        @error('specialization') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Certification</label>
                        <textarea wire:model="certification" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Certification details..."></textarea>
                        @error('certification') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-vnn-red text-white font-bold px-6 py-2.5 rounded text-sm hover:bg-vnn-red-dark transition">
                        {{ $editMode ? 'Update Fact Checker' : 'Create Fact Checker' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
