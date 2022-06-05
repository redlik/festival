<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Organisers list') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <p class="mt-2 text-sm text-gray-700">A list of all the organisers submitted via registration form.</p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add new organiser</button>
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Name</th>
                                            <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">Organisation</th>
                                            <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">Contact details</th>
                                            <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">Status</th>
                                            <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8 text-center">
                                                <span class="sr-only">Operations</span>
                                                Operations
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white">

                                        @forelse($organisers as $organiser)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $organiser->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $organiser->org }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div><strong>E:</strong> {{ $organiser->email }}</div>
                                                <div><strong>T:</strong> {{ $organiser->phone }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                @if($organiser->status == 'pending')
                                                <span class="gray-pillow">{{ ucfirst($organiser->status) }}</span>
                                                @endif
                                                @if($organiser->status == 'approved')
                                                    <span class="green-pillow">{{ ucfirst($organiser->status) }}</span>
                                                @endif
                                                @if($organiser->status == 'disabled')
                                                    <span class="gray-pillow">{{ ucfirst($organiser->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <a href="{{ route('organiser.show', $organiser) }}" class="text-indigo-600 hover:text-indigo-900 font-bold mr-2">View details</a>
                                                @if($organiser->status == 'pending')
                                                <a href="{{ route('approved.organiser', $organiser) }}" class="text-green-600 hover:text-green-900 font-bold mr-2">Approve</a>
                                                @endif
                                                @if($organiser->status == 'approved')
                                                    <a href="{{ route('approved.disabled', $organiser) }}" class="text-green-600 hover:text-green-900 font-bold mr-2">Disable</a>
                                                @endif
                                                @if($organiser->status == 'disabled')
                                                    <a href="{{ route('approved.organiser', $organiser) }}" class="text-green-600 hover:text-green-900 font-bold mr-2">Enable</a>
                                                @endif

                                                    <a href="#" class="text-red-600 hover:text-red-900 font-bold">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td>No organisers submitted</td>
                                        </tr>
                                        @endforelse


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
