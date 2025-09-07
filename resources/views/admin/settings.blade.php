<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Settings <a href="{{ route('admin.dashboard') }}" class="text-amber-800 cursor-pointer hover:text-amber-500 ml-4" title="Admin Dashboard"><i class="fa-solid fa-clipboard-user"></i></a>
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
          <div>
            <h3 class="mb-2">Booking start date</h3>
            @livewire('booking-date-form')
          </div>
          <hr class="border border-gray-200 mt-8 w-full">
          <div class="mt-8">
            <h3 class="mb-2">Homepage banner</h3>
            @livewire('homepage-banner')
          </div>

        </div>
    </div>
</x-app-layout>
