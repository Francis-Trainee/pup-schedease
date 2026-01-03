<div class="space-y-6"> <!-- root -->

    <!-- HEADER + ADD SUBJECT BUTTON -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Subject List</h2>
        <button wire:click="openModal" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
            + Add Subject
        </button>
    </div>

    <!-- ADD / EDIT MODAL -->
    @if ($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50" wire:click="closeModal"></div>

        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 z-10">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">{{ $isEdit ? 'Edit Subject' : 'Add Subject' }}</h3>
                <button wire:click="closeModal" class="text-gray-500 hover:text-red-600">✕</button>
            </div>

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <input wire:model.defer="subject_code" type="text" placeholder="Subject Code" class="border rounded-lg px-3 py-2 w-full">
                    @error('subject_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model.defer="description" type="text" placeholder="Description" class="border rounded-lg px-3 py-2 w-full">
                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model.defer="unit" type="number" placeholder="Units" class="border rounded-lg px-3 py-2 w-full">
                    @error('unit') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model.defer="lec_hours" type="number" placeholder="Lecture Hours" class="border rounded-lg px-3 py-2 w-full">
                    @error('lec_hours') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model.defer="lab_hours" type="number" placeholder="Lab Hours" class="border rounded-lg px-3 py-2 w-full">
                    @error('lab_hours') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2 flex justify-end gap-2">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 rounded-lg border">Cancel</button>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">{{ $isEdit ? 'Update' : 'Save' }}</button>
                </div>

            </form>
        </div>
    </div>
    @endif

    <!-- DEACTIVATE MODAL -->
    @if ($showDeactivateModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50" wire:click="closeDeactivateModal"></div>

        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6 z-10">
            <h3 class="text-lg font-semibold text-red-600 mb-2">Deactivate Subject</h3>

            <p class="text-sm text-gray-700 mb-4">
                You are about to deactivate <strong>{{ $subjectName }}</strong>.
            </p>

            <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-3 mb-4">
                <p class="text-sm text-yellow-800">
                    ⚠ Deactivating this subject may affect schedules and assignments.
                </p>
            </div>

            <div class="flex justify-end gap-2">
                <button wire:click="closeDeactivateModal" class="px-4 py-2 rounded-lg border">Cancel</button>
                <button wire:click="deactivateSubject" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Confirm Deactivate</button>
            </div>
        </div>
    </div>
    @endif

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-100 sticky top-0 z-10">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left">Subject Code</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Units</th>
                    <th class="px-6 py-3 text-left">Lecture Hours</th>
                    <th class="px-6 py-3 text-left">Lab Hours</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                <tr class="border-b">
                    <td class="px-6 py-3 whitespace-nowrap">{{ $subject->subject_code }}</td>
                    <td class="px-6 py-3 whitespace-nowrap">{{ $subject->description }}</td>
                    <td class="px-6 py-3 whitespace-nowrap">{{ $subject->unit }}</td>
                    <td class="px-6 py-3 whitespace-nowrap">{{ $subject->lec_hours }}</td>
                    <td class="px-6 py-3 whitespace-nowrap">{{ $subject->lab_hours }}</td>
                    <td class="flex gap-2 px-6 py-3">
                        <button wire:click="edit({{ $subject->id }})" class="text-blue-600 hover:underline">Edit</button>
                        <button wire:click="confirmDeactivate({{ $subject->id }})" class="text-red-600 hover:underline">Deactivate</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
