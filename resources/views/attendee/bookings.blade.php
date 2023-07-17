<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="mx-auto w-full">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p class="mt-2 text-sm text-gray-700 font-medium">List of all bookings you've made for yourself
                            and for other attendees, while using your login.</p>
                    </div>
                    @if (Session::has('deleted'))
                        <div
                            class="bg-red-100 border border-red-700 shadow rounded p-2 my-4 text-red-600">{{ Session::get('deleted') }}</div>
                    @endif
                    @if (Session::has('resend'))
                        <div
                            class="bg-green-100 border border-green-700 shadow-lg rounded p-2 my-4 text-green-700">{{ Session::get('resend') }}</div>
                    @endif

                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">
                                                Event
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">
                                                Date / Time
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">
                                                Event Status
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8 text-center">
                                                <span class="sr-only">Operations</span>
                                                Operations
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                        @forelse($bookings as $booking)
                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $booking->name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $booking->event->name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $booking->event->start_date }}
                                                    @
                                                    {{ \Carbon\Carbon::parse($booking->event->start_time)
                                                    ->format('H:i') }} </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ ucfirst($booking->event->status) }}
                                                </td>
                                                <td class="whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-semibold sm:pr-6">
                                                    <form action="{{ route('attendee.destroy', $booking) }}" method="POST" onsubmit="return confirm('Do you wish to cancel this booking?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if($booking->waiting_status)
                                                            <button type="submit" class="text-red-600 hover:text-red-900"><i class="fa-solid fa-trash-can"></i> Delete</button>
                                                        @else
                                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                                <i class="fa-solid fa-circle-minus"></i> Cancel</button>
                                                        @endif
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="5" class="text-center p-4">
                                                <h4>No bookings made, browse <a href="/events"
                                                                                class="hover:underline hover:text-gray-500">the
                                                        events list here</a></h4>
                                            </td>
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
