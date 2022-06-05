<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Application submitted') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div>
                <h2>Thank you!</h2>
                <p>Your application has been submitted. The organisers of the festival will review your information now.</p>
                <p>In the meantime you can view all the events that are happening at the festival here:
                    <a href="#" class="text-link">View all events</a></p>
            </div>
        </div>
    </div>
</x-app-layout>
