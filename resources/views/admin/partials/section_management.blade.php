<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Section Management') }}
        </h2>
        <p class="text-sm text-gray-500">
            Manage sections and their details.
        </p>
    </x-slot>

    <div class="p-6 max-w-7xl mx-auto">
        <livewire:admin.section-management />
    </div>
</x-app-layout>
