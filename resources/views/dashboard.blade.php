<x-app-layout>
    <div class="py-6">
        @php
            $role = auth()->user()->getRoleNames()->first();
        @endphp

        @if ($role)
            @if ($role === 'admin')
                @include('admin.partials.dashboard')
            @elseif ($role === 'student')
                @include('student.partials.dashboard')
            {{-- @elseif ($role === 'teacher')
                @include('teacher.partials.dashboard') --}}
            @else
                <p class="text-yellow-600">
                    {{ __('No dashboard available for your role.') }}
                </p>
            @endif
        @else
            <p class="text-red-600">
                {{ __("You're logged in but no role has been assigned.") }}
            </p>
        @endif
    </div>
</x-app-layout>
