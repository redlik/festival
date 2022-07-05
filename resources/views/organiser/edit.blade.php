<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Edit {{ $organiser->org }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg p-8">
                    @if(\Session::has('profile_updated'))
                        <div class="bg-green-100 border border-green-500 p-2 rounded mt-4">
                            The changes has been saved.
                            <a href="{{ route('dashboard') }}" class="font-bold text-indigo-500 hover:underline"><< Click to return to Dashboard</a>
                        </div>
                    @endif
                    <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('organiser.update', $organiser) }}" id="organiser-edit">
                        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                            <div>
                                @csrf
                                @method('PATCH')
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:py-5">
                                    <label for="org" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                        Company / Organisation <span class="text-red-700">*</span>
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input id="org" name="org" type="text" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required value="{{ $organiser->org }}">
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="phone" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                        Phone number <span class="text-red-700">*</span>
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input id="phone" name="phone" type="text" autocomplete="email" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $organiser->phone }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Online details
                                </h3>
                            </div>
                            <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                                    <label for="website" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Website
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="url" name="website" id="website" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $organiser->website }}">
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="facebook" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Facebook page
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="url" name="facebook" id="facebook" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $organiser->facebook }}">
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="twitter" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Twitter
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="url" name="twitter" id="twitter" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $organiser->twitter }}">
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="instagram" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Instagram
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="url" name="instagram" id="instagram" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $organiser->instagram }}">
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="linkedin" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Linkedin
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="url" name="linkedin" id="linkedin" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $organiser->linkedin }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-start">
                        <button type="submit" class="button-primary">
                            Save changes
                        </button>
                    </div>
                </div>
                </form>
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
