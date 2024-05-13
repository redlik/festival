<div class="px-4 sm:px-6 lg:px-8">

    <div class="sm:flex sm:items-center justify-between ml-4">
        <div class="flex items-center w-auto mr-8">
            <div>
                <input type="search" wire:model.live="search" name="search"
                       class="focus:ring-olive-500 text-gray-600 border-gray-300 rounded w-64 block px-2 py-1" placeholder="Search by name or org">
                @if($search !='')
                    <button wire:click="clear" class="text-xs font-semibold text-red-600 hover:underline mt-2 ml-2">Clear</button>
                @endif
            </div>

        </div>
        <div class="flex items-center w-auto mr-8">
            <select name="year" id="year" wire:model.live="year"
                    class="focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                <option value="" selected>All years</option>
                @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
            <label for="year" class="text-gray-700 text-sm ml-4 block w-full">Registration year</label>
        </div>
        <div class="flex items-center w-auto mr-8">
            <select name="year" id="year" wire:model.live="status"
                    class="focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                <option value="" selected>All statuses</option>
                <option value="activated">Activated</option>
                <option value="pending">Pending</option>
            </select>
            <label for="year" class="text-gray-700 text-sm ml-4 block w-full">Filter by status</label>
        </div>
        <div class="flex items-center w-auto mr-8">
            <input type="checkbox" wire:model.live="zero_count" name="zero_count"
            class="focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-sm">
            <label for="zero_count" class="ml-2">Organisers with no events</label>
        </div>
        <div class="flex gap-4">
            <div class="mt-4 sm:mt-0 sm:flex-none">
                <a href="{{ route('admin.organisers.export') }}" type="button"
                   class="inline-flex items-center justify-center rounded-md border border-transparent bg-yellow-300 px-4 py-2 text-sm font-medium text-olive-600 shadow-sm hover:bg-yellow-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    <i class="fas fa-file-excel mr-2"></i> Export list</a>
            </div>
            <div class="mt-4 sm:mt-0 sm:flex-none">
                <a href="{{ route('organiser.create') }}">
                    <button type="button"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-200 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                        Add new organiser
                    </button>
                </a>
            </div>
        </div>

    </div>
    @if (Session::has('deleted'))
        <div class="bg-red-100 border border-red-700 shadow rounded p-2 my-4 text-red-600">{{ Session::get('deleted') }}</div>
    @endif
    @if (Session::has('resend'))
        <div class="bg-green-100 border border-green-700 shadow-lg rounded p-2 my-4 text-green-700">{{ Session::get('resend') }}</div>
    @endif

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="text-sm font-semibold mb-4 ml-8">{{ $organisers->count() }} {{ \Illuminate\Support\Str::of('organiser')->plural($organisers->count())}} listed</div>
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300 table-auto">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"">#</th>
                            <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">Name</th>
                            <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">Organisation</th>
                            <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">Contact details</th>
                            <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">Events</th>
                            <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">Reg. date</th>
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
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $organiser->name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $organiser->org }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div><strong>E:</strong> {{ $organiser->email }}</div>
                                    <div><strong>T:</strong> {{ $organiser->phone }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $organiser->events_count ?? 0 }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $organiser->created_at->format('Y') }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if($organiser->status == 'pending')
                                        <span class="gray-pillow">{{ ucfirst($organiser->status) }}</span>
                                        <a href="{{ route('admin.resend-activation', $organiser) }}" title="Re-send activation email"><i class="fa-solid fa-rotate text-indigo-600 ml-2"></i></a>

                                    @endif
                                    @if($organiser->status == 'activated')
                                        <span class="green-pillow">{{ ucfirst($organiser->status) }}</span>
                                    @endif
                                    @if($organiser->status == 'disabled')
                                        <span class="gray-pillow">{{ ucfirst($organiser->status) }}</span>
                                    @endif
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-semibold sm:pr-6">
                                    <a href="{{ route('organiser.show', $organiser) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">View details</a>
                                    @if($organiser->status == 'activated')
                                        <a href="{{ route('admin.organiser.docs', $organiser) }}" class="text-amber-600 hover:text-indigo-900 mr-2">Docs</a>
                                    @endif
                                    @if($organiser->status == 'activated')
                                        <a href="{{ route('approved.disabled', $organiser) }}" class="text-green-600 hover:text-green-900 mr-2">Disable</a>
                                    @endif
                                    @if($organiser->status == 'disabled')
                                        <a href="{{ route('approved.organiser', $organiser) }}" class="text-green-600 hover:text-green-900 mr-2">Enable</a>
                                    @endif
                                    @if($organiser->status == 'pending')
                                        <form method="POST" action="{{ route('organiser.destroy', $organiser) }}" class="inline-block"
                                              onsubmit="return confirm('Do you wish to delete the organiser completely?');">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="text-red-600 hover:text-red-900 hover:underline">Delete</button>
                                        </form>
                                    @else
                                        <div class="text-gray-500 inline-block cursor-not-allowed" title="Organiser is already activated, cannot delete">Delete</div>

                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td  colspan="5" class="p-4 text-xl text-center">No organisers submitted</td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
