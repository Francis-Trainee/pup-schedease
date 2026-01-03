<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room Management') }}
        </h2>
        <p class="text-sm text-gray-500">
            Manage rooms and their availability.
        </p>
    </x-slot>

    <div class="p-6 max-w-7xl mx-auto">
        <livewire:admin.room-management />
    </div>
</x-app-layout>
