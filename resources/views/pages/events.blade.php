<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('List of all Festival events') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    @livewire('event-list')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
