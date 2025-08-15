<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Settings
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
          <div>
            <h3 class="mb-2">Booking start date</h3>
            @livewire('booking-date-form')
          </div>

        </div>
    </div>
</x-app-layout>
