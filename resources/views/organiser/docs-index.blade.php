<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Documents') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div class="flex justify-between items-center h-full mb-4">
                <div>
                    <a href="{{ route('admin.organisers') }}" class="text-sm font-semibold text-gray-600 rounded bg-gray-100 shadow-inner px-3 py-2 hover:bg-gray-300"><< Back to Organisers</a>
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
