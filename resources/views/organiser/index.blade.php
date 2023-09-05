<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Organisers list') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="mx-auto w-full">
                <div class="w-full text-center mb-8">
                    <p class="mt-2 text-xl text-gray-700">A list of all the organisers submitted via registration form.</p>
                </div>
                @livewire('organiser-list-admin')
            </div>
        </div>
    </div>
</x-app-layout>
