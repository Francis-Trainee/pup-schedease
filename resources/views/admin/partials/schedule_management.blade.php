<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule Management') }}
        </h2>
        <p class="text-sm text-gray-500">
            Manage schedules and their details.
        </p>
    </x-slot>

    <div class="p-6 max-w-7xl mx-auto">
        <livewire:admin.schedule-management />
    </div>
</x-app-layout>
