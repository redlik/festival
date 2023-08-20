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

    <div class="px-4 sm:px-6 lg:px-8 py-6 bg-gray-100 z-10" x-data="{docMessage: true}">
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
        @livewire('organiser-event-list', ['events' => $events])
    </div>


</x-app-layout>
