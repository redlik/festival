<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Events targets
        </h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-6 bg-gray-100 z-10">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth" x-data="{create : false}">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-100 rounded-l-lg">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">#</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Name</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Events</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 text-sm font-semibold sm:pr-6 lg:pr-8">Operations
                        <span class="sr-only">Operations</span>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($targets as $target)
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"> {{ $loop->iteration }}
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                            {{ $target->name }}
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                            {{ $target->events }}
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                            Delete
                        </td>

                    </tr>
                @empty
                    <tr >
                        <td colspan="7" class="p-8 text-center"><h4>No targets created</h4></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
