<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Delete attendees for {{ $year }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div class="mb-4">Deleted {{ $attendees->count() }} attendees from {{ $year }}.</div>
            <a href="{{ route('admin.dashboard') }}" class="font-bold text-olive-500 hover:underline">Return to Dashboard</a>
        </div>
    </div>

</x-app-layout>
