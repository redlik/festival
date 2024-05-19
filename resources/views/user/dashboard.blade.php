<x-app-layout>
    <x-slot name="header">
        <div class="relative">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Organiser Dashboard
            </h2>
            <div class="hidden lg:block absolute right-0 top-0">
                <div class="flex h-full items-center">
                    <a href="{{ route('dashboard.documents') }}" class="text-blue-600 mr-8 text-sm font-semibold hover:underline hover:text-blue-300"><i class="fa-solid fa-file mr-1"></i>Documents</a>
                    <a href="{{ route('organiser.edit', $organiser) }}">
                        <span class="text-sm text-green-600 font-semibold hover:text-gray-400 hover:underline"><i class="fa-solid fa-pen-to-square mr-1 "></i> Edit profile</span></a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-6 bg-gray-100 z-10"
         x-data="{openTab: window.location.hash ? window.location.hash : '#events',
                  activeClasses:
                  'bg-gray-600 text-gray-100 rounded-full shadow-inner shadow outline-none',
                  inactiveClasses:
                  'text-gray-500 bg-gray-200 hover:text-gray-700 hover:bg-gray-200 rounded-full cursor-pointer',
                  docMessage: true
                }">
            <div x-show='docMessage' class="max-w-7xl mx-auto bg-green-50 shadow-inner p-4 mt-6 rounded text-green-700 flex justify-between">
                <div>
                    For each event you are adding, please upload the following documents:
                    <ul class="list-disc list-inside">
                        <li>Relevant qualification,</li>
                        <li>Public liability insurance,</li>
                        <li>Garda vetting where relevant</li>
                    </ul>
                    <p class="text-green-700 mt-2">
                        <a href="{{ route('dashboard.documents') }}" class="underline font-bold">Click here</a> for document section
                    </p>
                </div>
                <div>
                    <button @click="docMessage = ! docMessage"><i class="fa-solid fa-square-xmark text-gray-400 text-lg"></i></button>
                </div>
            </div>
        <!---------- TABS ---------->
        <div class="flex items-center justify-center gap-10 w-full mt-6">
            <a @click="openTab = '#events'" :class="openTab === '#events' ? activeClasses : inactiveClasses"
               class="inline-block py-2 px-4 font-bold" >Events</a>
            <a @click="openTab = '#attendees'" :class="openTab === '#attendees' ? activeClasses : inactiveClasses"
               class="inline-block py-2 px-4 font-bold" >Attendees</a>
        </div>
        <!---------- END TABS ---------->
        <div x-show="openTab === '#events'">
            @livewire('organiser-event-list', ['events' => $events])
        </div>
        <div x-show="openTab === '#attendees'">
            <div class="p-6 border border-gray-200 rounded-lg mt-6 bg-white shadow-inner shadow-lg" id="attendees">
                @livewire('attendee-list')
            </div>
        </div>


    </div>


</x-app-layout>
