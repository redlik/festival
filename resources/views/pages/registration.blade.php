<x-seobox>
    Organiser registration - {{ config('app.name') }}
</x-seobox>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Organiser Registration Form') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div>
                <div class="text-sm my-4 bg-red-100 text-red-600 p-3 rounded font-semibold">
                    <p class="text-red-600">If you have already registered last year, you don't need to fill out the registration form again. Just use the login details to access the Dashboard.</p>
                    <a href="{{ route('login') }}" class="font-bold hover:underline mt-2">Login here</a></div>
                <p> Kerry Mental Health and Wellbeing Fest will take place from
                    <strong>5th – 12th October 2024</strong>. The key focus of the Fest is scheduling events that empower people to engage with the Five Ways to Wellbeing
                    <strong>(Connect | Give | Take Notice | Keep Learning | Be Active)</strong> as well as raising awareness of the available supports and services in the county. We aim to ensure the Fest has free events for people of all ages, backgrounds and abilities across the county. We would be delighted for you to get involved by hosting a free event(s) that promote the Five Ways to Wellbeing - whether you’re an educational body, organisation, agency, business, sports club, community group or qualified individual. </p>
            </div>
            <div class="my-8 p-4 rounded bg-gray-50">
                <h2 class="mb-4">All you need to do is:</h2>
                <ul class="list-disc list-inside">
                    <li><strong>Step 1</strong> – Register as an event organiser by filling in the short form below.</li>
                    <li><strong>Step 2</strong> - Activate your account by clicking on the link in the activation email that you will receive.</li>
                    <li><strong>Step 3</strong> - Create a password and then you are ready to add an event(s).
                        <span class="underline">All events need to be submitted by Thursday, 30th August to be considered.</span></li>
                    <li><strong>Step 4</strong> - The Fest Committee will review your event(s) prior to publishing them on the website.</li>

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
            @if ($errors->any())
                <div class="bg-red-200 rounded border border-red-400 pl-2 my-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('organiser.store') }}" id="organiser-registration">
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    <div>
                        @csrf
                        @honeypot
                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5" x-data="{ hear: '' }">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Organiser's Name
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="name" id="name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="email" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Email address <span class="text-red-700">*</span>
                                    <div class="text-xs text-red-600"><strong>Please note.</strong> This email will be used on the event pages to allow visitors to contact you directly.</div>
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
                                    <input id="phone" name="phone" type="text" autocomplete="phone" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="org" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Company / Organisation <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="org" name="org" type="text" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required value="{{ old('org') }}">
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
                                            <input id="garda_vetting_yes" aria-describedby="garda_vetting-description" name="garda_vetting" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" @checked(old('garda_vetting')) value="1" required>
                                            <label for="garda_vetting_yes" class="ml-4 text-gray-700 text-sm">Yes, I have current Garda Vetting.</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="garda_vetting_no" aria-describedby="garda_vetting-description" name="garda_vetting" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" @checked(old('garda_vetting')) value="0">
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
                                            <input id="public_liability_yes" aria-describedby="public_liability-description" name="public_liability_insurance" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" @checked(old('public_liability')) value="1" required>
                                            <label for="public_liability_yes" class="ml-4 text-gray-700 text-sm">Yes, I have Public Liability insurance.</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="public_liability_no" aria-describedby="public_liability-description" name="public_liability_insurance" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" @checked(old('garda_vetting')) value="0">
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
                                            <input id="indemnity_insurance_yes" aria-describedby="indemnity_insurance-description" name="indemnity_insurance" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" @checked(old('indemnity_insurance')) value="1" required>
                                            <label for="garda_vetting_yes" class="ml-4 text-gray-700 text-sm">Yes, I have up-to-date Professional Indemnity insurance.</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="indemnity_insurance_no" aria-describedby="indemnity_insurance-description" name="indemnity_insurance" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" @checked(old('indemnity_insurance')) value="0">
                                            <label for="garda_vetting_no" class="ml-4 text-gray-700 text-sm">No, I do not have up-to-date Professional Indemnity insurance.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="hear_about" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Where did you hear about us <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select x-model="hear" id="hear_about" name="hear_about" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                        @if(old('hear_about') === null)
                                        <option value="" disabled selected>Select from the list</option>
                                        @endif
                                        <option value="Social media" @selected(old('hear_about') == 'Social media')>Social media</option>
                                        <option value="Radio" @selected(old('hear_about') == 'Radio')>Radio</option>
                                        <option value="Newspaper" @selected(old('hear_about') == 'Newspaper')>Newspaper</option>
                                        <option value="Other event organiser" @selected(old('ear_about') == 'Other event organiser')>Other event organiser</option>
                                        <option value="Committee member" @selected(old('ear_about') == 'Committee member')>Committee member</option>
                                        <option value="Other" @selected(old('hear_about') == 'Other')>Other (please specify in the box below)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="other" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Other
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="other" name="other" x-bind:disabled="(hear == 'Other') ? false : true" x-bind:required="(hear == 'Other') ? true : false" type="text" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required value="{{ old('other') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="events" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Event(s) details <br/><span class="block lg:w-2/3 italic">Please provide brief information about each event you wish to organise.</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <textarea id="events" name="events" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md" required>{{ old('events') }}</textarea>
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
                                    <input type="text" name="address1" id="address1" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('address1') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="street" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Street
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="street" id="street" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('street') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="town" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    City / Town
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="town" id="town" class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" value="{{ old('town') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="eircode" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    EIRCODE
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="eircode" id="eircode" autocomplete="eircode" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md uppercase" value="{{ old('eircode') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="county" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    County
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select id="county" name="county" autocomplete="county" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                        @if(old('county') === null)
                                        <option value="" disabled selected>Select from the list</option>
                                        @endif
                                        <option value="Carlow" @selected(old('county') == 'Carlow')>Co. Carlow</option>
                                        <option value="Cavan" @selected(old('county') == 'Cavan')>Co. Cavan</option>
                                        <option value="Clare" @selected(old('county') == 'Clare')>Co. Clare</option>
                                        <option value="Cork" @selected(old('county') == 'Cork')>Co. Cork</option>
                                        <option value="Donegal" @selected(old('county') == 'Donegal')>Co. Donegal</option>
                                        <option value="Dublin" @selected(old('county') == 'Dublin')>Co. Dublin</option>
                                        <option value="Galway" @selected(old('county') == 'Galway')>Co. Galway</option>
                                        <option value="Kerry" @selected(old('county') == 'Kerry')>Co. Kerry</option>
                                        <option value="Kildare" @selected(old('county') == 'Kildare')>Co. Kildare</option>
                                        <option value="Kilkenny" @selected(old('county') == 'Kilkenny')>Co. Kilkenny</option>
                                        <option value="Laois" @selected(old('county') == 'Laois')>Co. Laois</option>
                                        <option value="Leitrim" @selected(old('county') == 'Leitrim')>Co. Leitrim</option>
                                        <option value="Limerick" @selected(old('county') == 'Limerick')>Co. Limerick</option>
                                        <option value="Louth" @selected(old('county') == 'Louth')>Co. Louth</option>
                                        <option value="Mayo" @selected(old('county') == 'Mayo')>Co. Mayo</option>
                                        <option value="Meath" @selected(old('county') == 'Meath')>Co. Meath</option>
                                        <option value="Monaghan" @selected(old('county') == 'Monaghan')>Co. Monaghan</option>
                                        <option value="Offaly" @selected(old('county') == 'Offaly')>Co. Offaly</option>
                                        <option value="Roscommon" @selected(old('county') == 'Roscommon')>Co. Roscommon</option>
                                        <option value="Sligo" @selected(old('county') == 'Sligo')>Co. Sligo</option>
                                        <option value="Tipperary" @selected(old('county') == 'Tipperary')>Co. Tipperary</option>
                                        <option value="Waterford" @selected(old('county') == 'Waterford')>Co. Waterford</option>
                                        <option value="Wexford" @selected(old('county') == 'Wexford')>Co. Wexford</option>
                                        <option value="Wicklow" @selected(old('county') == 'Wicklow')>Co. Wicklow</option>
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
                                    <input type="url" name="website" id="website" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md placeholder-gray-400" placeholder="https://www.mywebsite.com" value="{{ old('website') }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="facebook" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Facebook page
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="facebook" id="facebook" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md placeholder-gray-400" placeholder="https://www.facebook.com/my_page" value="{{ old('facebook') }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="twitter" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Twitter
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="twitter" id="twitter" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md placeholder-gray-400" placeholder="https://www.twitter.com/my_account" value="{{ old('twitter') }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="instagram" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Instagram
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="instagram" id="instagram" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md placeholder-gray-400" placeholder="https://www.instagram.com/my_account" value="{{ old('instagram') }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="linkedin" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    LinkedIn
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="linkedin" id="linkedin" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md placeholder-gray-400" placeholder="https://www.linkedin.com/my_account" value="{{ old('linkedin') }}">
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
                <li class="mb-2">In order to ensure the Fest is accessible and inclusive for all, we ask that all events are
                    <strong>free</strong>. In the spirit of this, we also ask that events are not used to raise funds or collect donations.</li>
                <li class="mb-2">The Fest Committee cannot provide funding to cover costs such as venues or facilitators. However, we may be able to support in identifying free options for these kinds of expenses, depending on the location, so please get in touch with us at
                    <a href="mailto:kerrymhwfest20@gmail.com" class="font-bold underline">kerrymhwfest20@gmail.com</a></li>
                <li class="mb-2">The Fest Committee will however promote the Fest, and your event(s) extensively in the weeks leading up to the Fest using a host of mediums.</li>
                <li>Please refer to the programme of events for last year's Fest (2023) which will remain on the website for the foreseeable future. We would be delighted to facilitate events of a similar nature as well as events that will bring something new and different to the Fest. We are particularly interested in events for adolescents and young adults, as they have been lacking in previous years.</li>
                <li class="mb-2">It is the sole responsibility of the event host to ensure the provision of adequate insurance - for all activities undertaken in the delivery of event(s). If an event host is bringing in an external facilitator, the event host is responsible for ensuring the facilitator has appropriate insurance and qualifications in place.</li>
                <li class="mb-2">Event hosts are also responsible for ensuring Garda Vetting is in place and is up-to-date for those facilitating the event(s) that will engage children and/or vulnerable adults.</li>
                <li class="mb-2">You can confirm relevant insurance, qualifications and Garda Vetting are in place for your event(s) by ticking the appropriate boxes when registering as an organiser on the website.</li>
                <li class="mb-2">The management of registration for each event is the responsibility of the agency or individual hosting. Unfortunately, the Fest Committee does not have the capacity to manage registrations on behalf of event hosts</li>
                <li class="mb-2">Please consider how you can make the event as accessible as possible for people of all abilities, considering where necessary those who are hearing or visually impaired, wheelchair users and neurodivergent. Please tick the relevant box when creating your event on the website to indicate if you are using a wheel-chair accessible venue</li>
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
