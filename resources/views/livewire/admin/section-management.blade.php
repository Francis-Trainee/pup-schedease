<div class="space-y-6"> <!-- root -->

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif
    
    <!-- HEADER + ADD SECTION BUTTON -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Section List</h2>
        <button wire:click="openModal" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
            + Add Section
        </button>
    </div>

    <!-- ADD / EDIT MODAL -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/50" wire:click="closeModal"></div>

            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 z-10">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">{{ $isEdit ? 'Edit Section' : 'Add Section' }}</h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-red-600">✕</button>
                </div>

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <input wire:model.defer="program" type="text" placeholder="Program"
                            class="border rounded-lg px-3 py-2 w-full">
                        @error('program')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input wire:model.defer="year_level" type="text" placeholder="Year Level"
                            class="border rounded-lg px-3 py-2 w-full">
                        @error('year_level')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input wire:model.defer="section_name" type="text" placeholder="Section Name"
                            class="border rounded-lg px-3 py-2 w-full">
                        @error('section_name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2 flex justify-end gap-2">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 rounded-lg border">Cancel</button>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">{{ $isEdit ? 'Update' : 'Save' }}</button>
                    </div>

                </form>
            </div>
        </div>
    @endif

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-100 sticky top-0 z-10">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left">Program</th>
                    <th class="px-6 py-3 text-left">Year Level</th>
                    <th class="px-6 py-3 text-left">Section Name</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr class="border-b">
                        <td class="px-6 py-3 whitespace-nowrap">{{ $section->program }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $section->year_level }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $section->section_name }}</td>
                        <td class="flex gap-2 px-6 py-3">
                            <button wire:click="edit({{ $section->id }})"
                                class="text-blue-600 hover:underline">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
