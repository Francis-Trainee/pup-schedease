<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty Management') }}
        </h2>
        <p class="text-sm text-gray-500">
            Manage faculty members and their assignments
        </p>
    </x-slot>

    <div class="p-6 max-w-7xl mx-auto">
        <livewire:admin.faculty-management/>
    </div>
</x-app-layout>
