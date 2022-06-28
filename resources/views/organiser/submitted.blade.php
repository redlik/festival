<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Application submitted') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div>
                <h2 class="mb-4">Thank you!</h2>
                <p class="mb-2">Your application has been submitted. We've sent an activation email to <strong>{{ $organiser->email }}</strong> so make sure you open it and follow the process.</p>
                <p class="mb-2">In rare occassions the activation email may end up in your junk/spam folder so please check it as well.</p>
                <p class="mb-2">In the meantime you can view all the events that are happening at the festival here:
                    <a href="/events" class="text-link">View all events</a></p>
            </div>
        </div>
    </div>
</x-app-layout>
