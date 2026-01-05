<div class="space-y-6">

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded shadow">
        {{-- BUTTON TO OPEN CREATE MODAL --}}
        <div class="flex mb-4 justify-between items-center">
            <!-- SEARCH BAR -->
            <input type="text" placeholder="Search schedules..." wire:model.debounce.300ms="search"
                class="border rounded px-3 py-2 w-full mr-4"/>

            <button wire:click="$set('createModal', true)"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mb-4">
                + Create Schedule
            </button>
        </div>

        <!-- TOP FILTERS -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">

            <!-- Academic Year -->
            <select wire:model="academicYear" class="form-select">
                <option value="">Acad Year</option>
                @foreach ($academic_years as $ay)
                    <option value="{{ $ay->id }}">
                        {{ $ay->year_start }} - {{ $ay->year_end }}
                    </option>
                @endforeach
            </select>

            <!-- Semester -->
            <select wire:model="semester" class="form-select">
                <option value="">Semester</option>
                <option value="1st">First Semester</option>
                <option value="2nd">Second Semester</option>
            </select>

            <!-- Program -->
            <select wire:model.live="program" class="form-select">
                <option value="">All Programs</option>
                @foreach ($programs as $prog)
                    <option value="{{ $prog }}">{{ $prog }}</option>
                @endforeach
            </select>

            <!-- Section -->
            <select wire:model="section" class="form-select">
                <option value="">All Sections</option>
                @foreach ($sections as $sec)
                    <option value="{{ $sec->id }}">
                        {{ $sec->year_level }} - {{ $sec->section_name }}
                    </option>
                @endforeach
            </select>

            <!-- Status -->
            <select wire:model="status" class="form-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    {{-- CREATE MODAL --}}
    @if ($createModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded w-1/2">
                <h2 class="text-lg font-semibold mb-4">Create Schedule</h2>

                {{-- Academic Year / Semester / Section --}}
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label>Academic Year</label>
                        <select wire:model="academic_year_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($academic_years as $ay)
                                <option value="{{ $ay->id }}">{{ $ay->year_start }} - {{ $ay->year_end }}
                                </option>
                            @endforeach
                        </select>
                        @error('academic_year_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Semester</label>
                        <select wire:model="semester" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="Summer">Summer</option>
                        </select>
                        @error('semester')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Section</label>
                        <select wire:model="section_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($sections as $s)
                                <option value="{{ $s->id }}">{{ $s->program_code ?? '' }} -
                                    {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Faculty / Subject / Room --}}
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label>Faculty</label>
                        <select wire:model="faculty_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($faculties as $f)
                                <option value="{{ $f->id }}">{{ $f->full_name }}</option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Subject</label>
                        <select wire:model="subject_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($subjects as $s)
                                <option value="{{ $s->id }}">{{ $s->code }} - {{ $s->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Room</label>
                        <select wire:model="room_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($rooms as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Day / Start / End Time --}}
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label>Day</label>
                        <select wire:model="day" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                        </select>
                        @error('day')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Start Time</label>
                        <input type="time" wire:model="start_time" class="border rounded w-full px-2 py-1">
                        @error('start_time')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>End Time</label>
                        <input type="time" wire:model="end_time" class="border rounded w-full px-2 py-1">
                        @error('end_time')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button wire:click="$set('createModal', false)" class="px-4 py-2 border rounded">Cancel</button>
                    <button wire:click="createSchedule" class="bg-red-700 text-white px-4 py-2 rounded">Create</button>
                </div>
            </div>
        </div>
    @endif

    {{-- EDIT MODAL --}}
    @if ($editModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded w-1/2">
                <h2 class="text-lg font-semibold mb-4">Edit Schedule</h2>

                {{-- Use same form fields as Create Modal --}}
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label>Academic Year</label>
                        <select wire:model="academic_year_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($academic_years as $ay)
                                <option value="{{ $ay->id }}">{{ $ay->year_start }} - {{ $ay->year_end }}
                                </option>
                            @endforeach
                        </select>
                        @error('academic_year_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Semester</label>
                        <select wire:model="semester" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="Summer">Summer</option>
                        </select>
                        @error('semester')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Section</label>
                        <select wire:model="section_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($sections as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->program }} - {{ $s->section_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label>Faculty</label>
                        <select wire:model="faculty_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($faculties as $f)
                                <option value="{{ $f->id }}">{{ $f->full_name }}</option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Subject</label>
                        <select wire:model="subject_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($subjects as $s)
                                <option value="{{ $s->id }}">{{ $s->code }} - {{ $s->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Room</label>
                        <select wire:model="room_id" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            @foreach ($rooms as $r)
                                <option value="{{ $r->id }}">{{ $r->room_name }}</option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label>Day</label>
                        <select wire:model="day" class="border rounded w-full px-2 py-1">
                            <option value="">Select</option>
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                        </select>
                        @error('day')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Start Time</label>
                        <input type="time" wire:model="start_time" class="border rounded w-full px-2 py-1">
                        @error('start_time')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>End Time</label>
                        <input type="time" wire:model="end_time" class="border rounded w-full px-2 py-1">
                        @error('end_time')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button wire:click="$set('editModal', false)" class="px-4 py-2 border rounded">Cancel</button>
                    <button wire:click="updateSchedule"
                        class="bg-blue-700 text-white px-4 py-2 rounded">Update</button>
                </div>
            </div>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-100 sticky top-0 z-10">
                <tr class="border-b">
                    <th class="px-6 py-3">Subject</th>
                    <th class="px-6 py-3">Faculty</th>
                    <th class="px-6 py-3">Room</th>
                    <th class="px-6 py-3">Day</th>
                    <th class="px-6 py-3">Time</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 whitespace-nowrap">{{ $schedule->subject->subject_code }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $schedule->faculty->full_name }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $schedule->room->room_name }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $schedule->day }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            {{ date('h:i A', strtotime($schedule->start_time)) }} -
                            {{ date('h:i A', strtotime($schedule->end_time)) }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <span
                                class="px-2 py-1 rounded text-xs {{ $schedule->status === 'Active' ? 'bg-green-100 text-green-700' : 'bg-gray-200' }}">
                                {{ $schedule->status }}
                            </span>
                        </td>
                        <td class="px-6 py-3 flex gap-2">
                            <button wire:click="edit({{ $schedule->id }})"
                                class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="delete({{ $schedule->id }})"
                                class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 px-6 py-3">
            {{ $schedules->links() }}
        </div>
    </div>
</div>
