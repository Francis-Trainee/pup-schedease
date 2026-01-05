<div class="space-y-6"> <!-- single root for Livewire -->

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- HEADER + ADD ROOM BUTTON -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Room List</h2>
        <button wire:click="openModal" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
            + Add Room
        </button>
    </div>

    <!-- ADD / EDIT ROOM MODAL -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">

            <!-- Background Overlay -->
            <div class="absolute inset-0 bg-black/50" wire:click="closeModal"></div>

            <!-- Modal Box -->
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 z-10">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">
                        {{ $isEdit ? 'Edit Room' : 'Add Room' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-red-600">
                        ✕
                    </button>
                </div>

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <input wire:model.defer="room_name" type="text" placeholder="Room Name"
                            class="border rounded-lg px-3 py-2 w-full">
                        @error('room_name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input wire:model.defer="room_type" type="text" placeholder="Room Type (Lecture/Lab)"
                            class="border rounded-lg px-3 py-2 w-full">
                        @error('room_type')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2 flex justify-end gap-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 rounded-lg border">
                            Cancel
                        </button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                            {{ $isEdit ? 'Update' : 'Save' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif

    <!-- DEACTIVATE ROOM MODAL -->
    @if ($showDeactivateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">

            <!-- Background Overlay -->
            <div class="absolute inset-0 bg-black/50" wire:click="closeDeactivateModal"></div>

            <!-- Modal Box -->
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6 z-10">

                <h3 class="text-lg font-semibold text-red-600 mb-2">
                    Deactivate Room
                </h3>

                <p class="text-sm text-gray-700 mb-4">
                    You are about to deactivate <strong>{{ $roomName }}</strong>.
                </p>

                <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-3 mb-4">
                    <p class="text-sm text-yellow-800">
                        ⚠ This room may be assigned to schedules.
                    </p>
                    <p class="text-xs text-yellow-700 mt-1">
                        Deactivating may affect schedules and assignments.
                    </p>
                </div>

                <div class="flex justify-end gap-2">
                    <button wire:click="closeDeactivateModal" class="px-4 py-2 rounded-lg border">
                        Cancel
                    </button>

                    <button wire:click="deactivateRoom"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                        Confirm Deactivate
                    </button>
                </div>

            </div>
        </div>
    @endif

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-100 sticky top-0 z-10">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left">Room Name</th>
                    <th class="px-6 py-3 text-left">Room Type</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr class="border-b">
                        <td class="px-6 py-3 whitespace-nowrap">{{ $room->room_name }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $room->room_type }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <span
                                class="px-2 py-1 rounded-full text-xs {{ $room->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($room->status) }}
                            </span>
                        </td>
                        <td class="flex gap-2 px-6 py-3">
                            <button wire:click="edit({{ $room->id }})"
                                class="text-blue-600 hover:underline">Edit</button>

                            <button wire:click="confirmDeactivate({{ $room->id }})"
                                class="{{ $room->status === 'active' ? 'text-red-600' : 'text-green-600' }}">
                                {{ $room->status === 'active' ? 'Deactivate' : 'Activate' }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div> <!-- END ROOT -->
