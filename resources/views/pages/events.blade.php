<x-seobox>
    Event list - {{ config('app.name') }}
</x-seobox>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('List of all Fest events') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    @if(\Illuminate\Support\Facades\Session::has('created'))
                        <div class="bg-green-100 text-green-700 rounded p-2 mb-6 text-center">Your account has been created. You can now register for events.</div>
                    @endif
                    @livewire('event-list')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
