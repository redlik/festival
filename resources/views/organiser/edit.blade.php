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
                                        <input id="phone" name="phone" type="text" autocomplete="email"
                                               class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                               value="{{ $organiser->phone }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start items-centre sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="garda_vetting" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                Garda Vetting
                                <div class="italic text-xs mr-0 lg:mr-8">If you are hosting an event with children or vulnerable adults, please tick the box to signify that you have Garda Vetting.</div>
                            </label>
                            <div class="mt-4 lg:mt-1 sm:col-span-2 h-full">
                                <div class="h-full">
                                    <div class="flex items-center mb-2">
                                        <input id="garda_vetting_yes" aria-describedby="garda_vetting-description"
                                               name="garda_vetting" type="radio"
                                               class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                               @checked($organiser->garda_vetting) value="1" required>
                                        <label for="garda_vetting_yes" class="ml-4 text-gray-700 text-sm">Yes, I have current Garda Vetting.</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="garda_vetting_no" aria-describedby="garda_vetting-description" name="garda_vetting" type="radio"
                                               class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                               @checked(!$organiser->garda_vetting) value="0">
                                        <label for="garda_vetting_no" class="ml-4 text-gray-700 text-sm">No, I do not have current Garda Vetting.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start items-centre sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="garda_vetting" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                Public Liability Insurance
                                <div class="italic text-xs">Do you have up-to-date public liability insurance?</div>
                            </label>
                            <div class="mt-4 lg:mt-1 sm:col-span-2 h-full">
                                <div class="h-full">
                                    <div class="flex items-center mb-2">
                                        <input id="public_liability_yes" aria-describedby="public_liability-description" name="public_liability_insurance" type="radio"
                                               class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                               @checked($organiser->public_liability_insurance) value="1" required>
                                        <label for="public_liability_yes" class="ml-4 text-gray-700 text-sm">Yes, I have Public Liability insurance.</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="public_liability_no" aria-describedby="public_liability-description" name="public_liability_insurance" type="radio"
                                               class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                               @checked(!$organiser->public_liability_insurance) value="0">
                                        <label for="public_liability_no" class="ml-4 text-gray-700 text-sm">No, I do not have Public Liability insurance.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start items-centre sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="garda_vetting" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                Professional Indemnity Insurance
                                <div class="italic text-xs">Do you have up-to-date professional indemnity insurance relevant to the event(s) you are delivering?</div>
                            </label>
                            <div class="mt-4 lg:mt-1 sm:col-span-2 h-full">
                                <div class="h-full">
                                    <div class="flex items-center mb-2">
                                        <input id="indemnity_insurance_yes" aria-describedby="indemnity_insurance-description" name="indemnity_insurance" type="radio"
                                               class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                               @checked($organiser->indemnity_insurance) value="1" required>
                                        <label for="garda_vetting_yes" class="ml-4 text-gray-700 text-sm">Yes, I have up-to-date Professional Indemnity insurance.</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="indemnity_insurance_no" aria-describedby="indemnity_insurance-description" name="indemnity_insurance" type="radio"
                                               class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                               @checked(!$organiser->indemnity_insurance) value="0">
                                        <label for="garda_vetting_no" class="ml-4 text-gray-700 text-sm">No, I do not have up-to-date Professional Indemnity insurance.</label>
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
