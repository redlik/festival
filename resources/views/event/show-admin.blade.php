<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg pt-2">
                @if (\Session::has('approved'))
                    <div class="bg-green-200 border border-gray-400 shadow rounded p-2 mb-8">
                        The event has been approved
                    </div>
                @endif
                @if (\Session::has('pending'))
                    <div class="bg-gray-100 border border-gray-400 shadow rounded p-2 mb-8">
                        This event has been set to pending
                    </div>
                @endif
                <div class="flex justify-between">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Event details</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Review the information below and proceed with approval or ask for more details</p>
                    </div>
                    <div class="pt-2 pr-2 font-semibold">
                        {{ ucfirst($event->status) }}
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Event name</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $event->name }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Event date & time</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $event->start_date }} <span class="text-olive-500">@</span> {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} : {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') ?? "Not set" }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Organiser</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $event->user->name }} @ {{ $event->user->organiser->org }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Venue</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $event->venue->name }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $event->description }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Cover photo</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <img src="{{ $event->getFirstMediaUrl('cover') }}" alt="" class="w-36 h-36 object-contain">
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Target</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @foreach($event->target as $target_item)
                                    <div class="gray-pillow mr-1">
                                        {{ Str::title(str_replace('-', ' ', $target_item)) }}
                                    </div>
                                @endforeach
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Environment</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ ucfirst($event->type) }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Limited spaces</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @if($event->limited)
                                <span>Yes, </span><span>{{ $event->attendees }} spaces</span>
                                @else
                                    No limit set
                                @endif
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Submited at</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $event->created_at->format( 'd M Y @ H:i')}}
                            </dd>
                        </div>
                        @if($event->leader_name)
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Event leader details</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $event->leader_name }}, E: {{ $event->leader_email ?? 'Not set'}}, T: {{ $event->leader_phone ?? 'Not set'}}
                                </dd>
                            </div>
                        @endif

                        <div class="p-4">
                            @if($event->status != 'published')
                                <a href="{{ route('admin.event.approve', $event->id) }}">
                                    <button class="button-primary">Approve event</button>
                                </a>
                            @else
                                <a href="{{ route('admin.event.unpublish', $event->id) }}">
                                    <button class="button-primary bg-gray-600 hover:bg-gray-800">Unpublish event</button>
                                </a>
                            @endif
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
