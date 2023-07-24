<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="mx-auto w-full">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p class="mt-2 text-sm text-gray-700 font-medium">List of all bookings you've made for yourself
                            and for other attendees, while using your login.</p>
                    </div>
                    @if (Session::has('deleted'))
                        <div
                            class="bg-red-100 border border-red-700 shadow rounded p-2 my-4 text-red-600">{{ Session::get('deleted') }}</div>
                    @endif
                    @if (Session::has('resend'))
                        <div
                            class="bg-green-100 border border-green-700 shadow-lg rounded p-2 my-4 text-green-700">{{ Session::get('resend') }}</div>
                    @endif

                    @livewire('booking-list')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
