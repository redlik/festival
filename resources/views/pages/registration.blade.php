<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Organiser Registration Form') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div>
                <p> Kerry Mental Health and Wellbeing Fest will take place from
                    <strong>8th – 15th October 2022</strong>. The key focus of the Fest is scheduling events that empower people to engage with the Five Ways to Wellbeing
                    <strong>(Connect | Give | Take Notice | Keep Learning | Be Active)</strong> as well as raising awareness of the available supports and services in the county.</p>
                <p>We aim to ensure the Fest has free events for people of all ages, backgrounds and abilities across the county. We would be delighted for you to get involved by hosting a free event(s) that promote the Five Ways to Wellbeing - whether you’re an educational body, organisation, agency, business, sports club, community group or qualified individual. </p>
            </div>
            <div class="my-8 p-4 rounded bg-gray-50">
                <h2 class="mb-4">All you need to do is:</h2>
                <ul class="list-disc ml-3">
                    <li><strong>Step 1</strong> – Register as an event organiser by filling in the short form below.
                        <span class="underline">This needs to be completed by Friday 22nd July.</span></li>
                    <li><strong>Step 2</strong> - Activate your account and create a password.</li>
                    <li><strong>Step 3</strong> - Once activated, your account will be ready to create events.
                        <span class="underline">All events need to be uploaded by Friday 5th August to be considered.</span></li>
                </ul>
                <div class="mt-4 rounded p-2 bg-yellow-200 text-black"> <h5>Please
                        <a href="#guidelines" class="underline text-olive-600 font-bold">read the guidelines</a> for event organisers below before filling the form.
                    </h5></div>
            </div>
            <div>
                <h3 class="leading-6 text-2xl mb-2">
                    Registration form
                </h3>
            </div>
            <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('organiser.store') }}" id="organiser-registration">
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    <div>
                        @csrf
                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5" x-data="{ hear: '' }">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Organiser's Name
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="name" id="name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="email" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Email address <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="phone" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Phone number <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="phone" name="phone" type="text" autocomplete="email" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="org" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Company / Organisation <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="org" name="org" type="text" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="hear_about" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Where did you hear about us <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select x-model="hear" id="hear_about" name="hear_about" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                        <option value="" disabled selected>Select from the list</option>
                                        <option value="Social media">Social media</option>
                                        <option value="Radio">Radio</option>
                                        <option value="Newspaper">Newspaper</option>
                                        <option value="Other event organiser">Other event organiser</option>
                                        <option value="Committee member">Committee member</option>
                                        <option value="Other">Other (please specify in the box below)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="other" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Other
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="other" name="other" x-bind:disabled="(hear == 'Other') ? false : true" x-bind:required="(hear == 'Other') ? true : false" type="text" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="events" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Event(s) details <br/><span class="block lg:w-2/3 italic">Please provide brief information about each event you wish to organise.</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <textarea id="events" name="events" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md" required></textarea>
                                    <p class="mt-2 text-sm text-gray-700 font-semibold">This will be used to describe the events to the public in promotional material - please provide two to three sentences.</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Address details
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-700">
                                Use a permanent address where you can receive mail.
                            </p>
                        </div>
                        <div class="space-y-6 sm:space-y-5">

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="address1" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Address Line 1
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="address1" id="address1" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="street" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Street
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="street" id="street" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="town" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    City / Town
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="town" id="town" class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="eircode" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    EIRCODE
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="eircode" id="eircode" autocomplete="eircode" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="county" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    County
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select id="county" name="county" autocomplete="county" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                        <option value="" disabled selected>Select from the list</option>
                                        <option value="Carlow">Co. Carlow</option>
                                        <option value="Cavan">Co. Cavan</option>
                                        <option value="Clare">Co. Clare</option>
                                        <option value="Cork">Co. Cork</option>
                                        <option value="Donegal">Co. Donegal</option>
                                        <option value="Dublin">Co. Dublin</option>
                                        <option value="Galway">Co. Galway</option>
                                        <option value="Kerry">Co. Kerry</option>
                                        <option value="Kildare">Co. Kildare</option>
                                        <option value="Kilkenny">Co. Kilkenny</option>
                                        <option value="Laois">Co. Laois</option>
                                        <option value="Leitrim">Co. Leitrim</option>
                                        <option value="Limerick">Co. Limerick</option>
                                        <option value="Louth">Co. Louth</option>
                                        <option value="Mayo">Co. Mayo</option>
                                        <option value="Meath">Co. Meath</option>
                                        <option value="Monaghan">Co. Monaghan</option>
                                        <option value="Offaly">Co. Offaly</option>
                                        <option value="Roscommon">Co. Roscommon</option>
                                        <option value="Sligo">Co. Sligo</option>
                                        <option value="Tipperary">Co. Tipperary</option>
                                        <option value="Waterford">Co. Waterford</option>
                                        <option value="Wexford">Co. Wexford</option>
                                        <option value="Wicklow">Co. Wicklow</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Online details
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-700">
                                Please provide details including your website and social media accounts.
                                <span class="underline"> One link per box only.</span>
                            </p>
                        </div>
                        <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="website" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Website
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="website" id="website" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="facebook" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Facebook page
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="facebook" id="facebook" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="twitter" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Twitter
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="twitter" id="twitter" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="instagram" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Instagram
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="instagram" id="instagram" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-start">
                        <button type="submit" class="button-primary">
                            Submit application
                        </button>
                    </div>
                </div>
            </form>
        <div class="bg-gray-100 p-6 rounded my-8">
            <h2 id="guidelines">Guidelines</h2>
            <h5 class="my-4">Guidelines for organisations and qualified individuals hosting events:</h5>
            <ul class="list-decimal list-inside">
                <li>In order to ensure the Fest is accessible and inclusive for all, we ask that all events are free. In the spirit of this, we also ask that events are not used to raise funds or collect donations.</li>
                <li>The programme of events for 2021 can be found <a href="https://www.healthykerry.ie/wp-content/uploads/2021/09/KerryWellfest-A5Brochure64673_WEB.pdf" target="_blank" class="underline text-olive-600 font-bold">here</a> – we would be delighted to facilitate events of a similar nature as well as events that will bring something new and different to the Fest.</li>
                <li>It is the sole responsibility of the event host to ensure the provision of adequate insurance for all activities undertaken in the delivery of event(s).</li>
                <li>If you are registering as a qualified practitioner and this is your first time participating in the Fest, we ask that you share a copy of your qualification(s) and your professional indemnity insurance with us when registering your event.</li>
                <li>Event host are responsible for ensuring Garda Vetting is in place and is up-to-date to host all event(s) with children and/or vulnerable adults.</li>
                <li>The steering group cannot provide funding to cover costs such as venues or facilitators. However, we may be able to support in identifying free options for these kinds of expenses, depending on the location, so please get in touch with us at
                    <a href="mailto:kerrymhwfest20@gmail.com" class="underline text-olive-600 font-bold">kerrymhwfest20@gmail.com</a></li>
                <li>The management of registration for each event is the responsibility of the agency or individual hosting. Unfortunately, the steering group does not have the capacity to manage registrations on behalf of hosts.</li>
                <li>The steering group will however promote the Fest, and your event(s) extensively in the weeks leading up to the Fest using a host of mediums.</li>
                <li>Please consider how you can make the event as accessible as possible for people of all abilities, considering where necessary those who are hearing or visually impaired, wheelchair users and neuro-diverse people.</li>
            </ul>
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
