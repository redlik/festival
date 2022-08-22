<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Documents') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div class="flex justify-between items-center h-full mb-4">
                <div>
                    <button class="button-primary" @click="open = ! open">+ Add new</button>
                </div>
                <div>
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 rounded bg-gray-100 shadow-inner px-3 py-2 hover:bg-gray-300"><< Back to Dashboard </a>
                </div>
            </div>

            <div>
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
                @forelse($documents as $document)

                        <tr>
                            <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ $loop->iteration  }}</td>
                            <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 hidden sm:table-cell">
                                <div>{{ ucfirst($document->name) }}</div>
                                <div class="text-xs text-gray-400">
                                    <ul class="list-disc list-inside">
                                        @foreach($document->event as $assigned)
                                            <li>
                                                {{$assigned->name}}
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
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

                @empty
                    <tr>
                        <td colspan="5" class="py-4">
                            <h6 class="text-center text-gray-400 text-sm">No documents uploaded</h6>
                        </td>
                    </tr>
                @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Modal -->
            <div @keydown.window.escape="open = false" x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open = false" aria-hidden="true">
                    </div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                            <button type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="open = false">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Add new document
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 mb-4">
                                        Please upload the document below, and if the document is related to any of your events select the appropriate box(es).
                                    </p>
                                    <form action="{{ route('document.store') }}" method="POST" class="bg-gray-100 rounded p-2" enctype='multipart/form-data' id="doc-upload">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="name" class="text-sm text-gray-600">Name of the document</label>
                                            <input type="text" name="name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required>
                                            <div class="text-xs text-gray-600 mt-1">Use this field as a short description what the document is about.</div>
                                        </div>
                                        <div class="mb-4">
                                            <input type="file" name="file"></div>
                                        <div class="mb-4">
                                            <div class="font-bold text-gray-600 mb-1">Events:</div>
                                            @foreach($events as $event)
                                                <div class="relative flex items-start mb-1">
                                                    <div class="flex items-center h-5">
                                                        <input id="{{ $event->slug }}" aria-describedby="comments-description" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" name="events[]" value="{{ $event->id }}">
                                                    </div>
                                                    <div class="ml-3 text-sm">
                                                        <label for="events" class="font-medium text-gray-700">{{$event->name}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit" form="doc-upload" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-olive-600 text-base font-semibold text-white hover:bg-olive-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false">
                                Upload
                            </button>
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" @click="open = false">
                                Cancel
                            </button>
                        </div>
                    </div>

                </div>
            </div>



        </div>

    </div>
    @push("footer_styles")
        <script type="text/javascript">
            document.addEventListener('keypress', function (e) {
                if (e.keyCode === 13 || e.which === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        </script>
    @endpush
</x-app-layout>
