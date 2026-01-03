<x-slot name="header">
    <h2 class="font-bold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
    <p class="text-sm text-gray-500">
        Monitor and manage your institution's scheduling activities
    </p>
</x-slot>

<div class="w-full p-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    <!-- TOP ICON CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col items-start">
            <x-icons.users class="w-10 h-10 text-indigo-600" />
            <h3 class="text-sm text-gray-500">Faculty</h3>
            <p class="text-3xl font-bold text-gray-800">
                {{ $totalFaculties }}
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col items-start">
            <x-icons.rooms class="w-10 h-10 text-blue-600" />
            <h3 class="text-sm text-gray-500">Total Rooms</h3>
            <p class="text-3xl font-bold text-gray-800">
                {{ $totalRooms }}
            </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col items-start">
            <x-icons.subjects class="w-10 h-10 text-green-600" />
            <h3 class="text-sm text-gray-500">Total Subjects</h3>
            <p class="text-3xl font-bold text-gray-800">
                {{ $totalSubjects }}
            </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col items-start">
            <x-icons.sections class="w-10 h-10 text-blue-600" />
            <h3 class="text-sm text-gray-500">Total Sections</h3>
            <p class="text-3xl font-bold text-gray-800">
                {{ $totalSections }}
            </p>
        </div>

        <!-- Card 5 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col items-start">
            <x-icons.check class="w-10 h-10 text-yellow-600" />
            <h3 class="text-sm text-gray-500">Published</h3>
            <p class="text-3xl font-bold text-gray-800">
                {{-- {{ $totalPublishedSections }} --}}
            </p>
        </div>

        <!-- Card 6 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col items-start">
            <x-icons.ekis class="w-10 h-10 text-red-600" />
            <div class="mt-4 text-2xl font-bold text-gray-800">20</div>
            <div class="text-sm text-gray-500">Un-Published</div>
        </div>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- WEEKLY SCHEDULE -->
        <div class="lg:col-span-8 bg-white rounded-2xl shadow p-5 flex flex-col h-full">
            <div class="flex items-center justify-between mb-4">
                <!-- Heading -->
                <h2 class="bg-pup-red text-white px-4 py-2 rounded-full w-fit">
                    Weekly Schedule Overview
                </h2>

                <!-- Dropdowns -->
                <div class="flex gap-2">
                    <!-- Program -->
                    <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2">
                        <option selected disabled>Program</option>
                        <option>BSIT</option>
                        <option>BSCS</option>
                        <option>BSIS</option>
                    </select>

                    <!-- Year -->
                    <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2">
                        <option selected disabled>Year</option>
                        <option>1st Year</option>
                        <option>2nd Year</option>
                        <option>3rd Year</option>
                        <option>4th Year</option>
                    </select>

                    <!-- Semester -->
                    <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2">
                        <option selected disabled>Semester</option>
                        <option>1st Sem</option>
                        <option>2nd Sem</option>
                    </select>
                </div>
            </div>


            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="text-left border-b-2 border-gray-200">
                            <th class="py-2">Day</th>
                            <th>Time</th>
                            <th>Subject</th>
                            <th>Faculty</th>
                            <th>Room</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 8; $i++)
                            <tr class="border-b">
                                <td class="py-3">&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT SIDE: QUICK ACTIONS + SYSTEM ALERTS -->
        <div class="lg:col-span-4 flex flex-col gap-6">

            <!-- QUICK ACTIONS -->
            <div class="bg-white rounded-2xl shadow p-5 flex-1 flex flex-col">
                <div class="grid grid-cols-2 gap-4 flex-1">
                    <a href="{{ route('admin.faculty_management') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-xl p-4 text-center transition">
                        Manage Faculty
                    </a>
                    <a href="{{ route('admin.section_management') }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white rounded-xl p-4 text-center transition">
                        Manage Sections
                    </a>
                    <a href="{{ route('admin.room_management') }}"
                        class="bg-green-500 hover:bg-green-600 text-white rounded-xl p-4 text-center transition">
                        Manage Rooms
                    </a>
                    <a href="{{ route('admin.subject_management') }}"
                        class="bg-purple-500 hover:bg-purple-600 text-white rounded-xl p-4 text-center transition">
                        Manage Subjects
                    </a>
                    <a href="{{ route('admin.schedule_management') }}"
                        class="bg-green-700 hover:bg-green-800 text-white rounded-xl p-4 text-center col-span-2 transition">
                        Create Schedule
                    </a>
                    <a href="{{ route('admin.reports') }}"
                        class="bg-red-600 hover:bg-red-700 text-white rounded-xl p-4 text-center col-span-2 transition">
                        Print Reports
                    </a>
                </div>
            </div>

            <!-- SYSTEM ALERTS -->
            <div class="bg-white rounded-2xl shadow p-5 flex-1 flex flex-col">
                <h2 class="text-pup-red font-bold mb-4 text-lg">System Alerts</h2>
                <div class="space-y-3 flex-1 overflow-y-auto">
                    <div class="border rounded-lg p-3"></div>
                    <div class="border rounded-lg p-3"></div>
                    <div class="border rounded-lg p-3"></div>
                </div>
            </div>

        </div>

    </div>
</div>
