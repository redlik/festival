<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div class="">
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
                            @if($event->type === 'online')
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    Online event
                                </dd>
                            @else
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $event->venue->name }}</dd>
                            @endif
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $event->description }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Cover photo</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <img src="{{ $event->getFirstMediaUrl('cover') }}" alt="{{ $event->name }}" class="w-36 h-36 object-contain">
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Target</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @foreach(json_decode($event->target) as $target_item)
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
                            @if($event->status == 'pending')
                                <a href="{{ route('admin.event.approve', $event->id) }}">
                                    <button class="button-primary">Approve event</button>
                                </a>
                            @endif
                            @if($event->status == 'published')
                                <a href="{{ route('admin.event.unpublish', $event->id) }}">
                                    <button class="button-primary bg-gray-600 hover:bg-gray-800">Unpublish event</button>
                                </a>
                            @endif
                        </div>
                    </dl>
                </div>
            </div>
            <div class="mt-8" x-data="{ request : false }">
                <div class="flex justify-between">
                    <div>
                        <h6>Documents attached</h6>
                    </div>
                    <div>
                        <button @click="request = true" class="button-primary text-xs" type="button">Request documents</button>
                    </div>
                </div>

                <div class="mt-4">
                    <table class="min-w-full border-separate" style="border-spacing: 0">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">#</th>
                            <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">Name & events</th>
                            <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">File</th>
                            <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">Uploaded at</th>
                            <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter text-sm text-right sm:pr-6 lg:pr-8">
                                <span class="sr-only">Edit</span>Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($event->document as $document)
                                <tr>
                                    <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ $loop->iteration  }}</td>
                                    <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 hidden sm:table-cell">
                                        <div>{{ ucfirst($document->name) }}</div>
                                    </td>
                                    <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 hidden lg:table-cell">
                                        <a href="{{ $document->getFirstMediaUrl('docs') }}" class="text-indigo-500 hover:underline hover:text-indigo-800" target="_blank">Click to preview</a>
                                    </td>
                                    <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 hidden lg:table-cell">{{ $document->created_at->format('d M y @ H:i') }}</td>
                                    <td class="relative whitespace-nowrap border-b border-gray-200 py-4 pr-4 pl-3 text-right text-sm font-medium sm:pr-6 lg:pr-8">
                                        <form action="{{ route('document.destroy', $document) }}"></form>
                                        <form method="POST" action="{{ route('document.destroy', $document) }}" class="inline-block"
                                              onsubmit="return confirm('Do you wish to delete the document?');">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="text-red-600 hover:text-red-900 hover:underline"><i class="fa-solid fa-trash-can text-xs" title="Delete event"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div @keydown.window.escape="request = false" x-show="request" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                        <div x-show="request" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="request = false" aria-hidden="true">
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                        <div x-show="request" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                                <button type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="request = false">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Request document(s) from the organiser
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 mb-4">
                                            Provide a short description what documents are required.
                                        </p>
                                        <form action="{{ route('admin.event.request-docs', $event) }}" method="POST" class="bg-gray-100 rounded p-2" id="doc-request">
                                            @csrf
                                            <div class="mb-4">
                                                <label for="message" class="text-sm text-gray-600 font-semibold mb-2">Request details:</label>
                                                <textarea name="message" id="message" cols="30" rows="6" class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"></textarea>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button type="submit" form="doc-request" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-olive-600 text-base font-semibold text-white hover:bg-olive-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="request = false">
                                    Send
                                </button>
                                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" @click="request = false">
                                    Cancel
                                </button>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
