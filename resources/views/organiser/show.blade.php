<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ $organiser->name }} @ {{ $organiser->org }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Organiser information
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    All the details from the application form.
                                </p>
                            </div>
                            <div>
                                <h4>{{ ucfirst($organiser->status) }}</h4>
                            </div>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Full name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $organiser->name }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Organisation
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $organiser->org }}
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Email address
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $organiser->email }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Phone
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $organiser->phone }}
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Proposed events
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {!! nl2br(e($organiser->events))!!}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Address
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $organiser->address1 }}<br>
                                        {{ $organiser->street }}<br>
                                        {{ $organiser->town }}<br>
                                        {{ $organiser->county }}<br>
                                        {{ $organiser->eircode }}<br>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Where did you her about us:
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $organiser->hear_about }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Online details
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <i class="fas fa-globe mr-2"></i>{{ $organiser->website ?? 'N/A'}}<br>
                                        <i class="fab fa-facebook-square mr-2"></i>{{ $organiser->facebook ?? 'N/A'}}<br>
                                        <i class="fab fa-twitter-square mr-2"></i>{{ $organiser->twitter ?? 'N/A'}}<br>
                                        <i class="fab fa-instagram-square mr-2"></i>{{ $organiser->instagram ?? 'N/A'}}<br>
                                    </dd>
                                </div>



                            </dl>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
