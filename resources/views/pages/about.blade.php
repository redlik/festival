<x-app-layout>
    <x-slot name="header">
    </x-slot>

    @push('extra_styles')
        <style>
            #white-header {
                display: none;
            }
        </style>
    @endpush
    <div class="w-full h-1/3 shadow-lg">
        <img src="{{ asset('img/olympians-mental-health-01.jpg') }}" class="shadow-lg lg:h-[500px] object-cover w-full" alt="">
    </div>
    <div class="bg-white py-8 px-4 overflow-hidden sm:px-6 lg:px-8 lg:py-8">

        <div class="relative max-w-7xl mx-auto">
            <svg class="absolute left-full transform translate-x-1/2" width="404" height="404" fill="none" viewBox="0 0 404 404" aria-hidden="true">
                <defs>
                    <pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"></rect>
                    </pattern>
                </defs>
                <rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)"></rect>
            </svg>
            <svg class="absolute right-full bottom-0 transform -translate-x-1/2" width="404" height="404" fill="none" viewBox="0 0 404 404" aria-hidden="true">
                <defs>
                    <pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"></rect>
                    </pattern>
                </defs>
                <rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)"></rect>
            </svg>

            <div class="my-12" x-data="{ imgModal : false, imgModalSrc : '', imgModalDesc : '' }">
                <template @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc; imgModalDesc = $event.detail.imgModalDesc;" x-if="imgModal">
                    <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="imgModalSrc = ''" class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
                        <div @click.away="imgModal = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
                            <div class="z-50">
                                <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                                    <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-2">
                                <img :alt="imgModalSrc" class="object-contain h-1/2-screen" :src="imgModalSrc">
                                <p x-text="imgModalDesc" class="text-center text-white"></p>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="w-full grid grid-cols-1 lg:grid-cols-5 gap-4 mb-12">
                    <div class="col-span-2">
                        <div>
                            <h1>About the Festival</h1>
                            <h4>and a little bit of history</h4>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <p class="mb-4">
                            Kerry’s first Mental Health and Wellbeing Fest was held in October 2018.  This project was led by the HSE Cork Kerry Community Healthcare through Connecting for Life, and Kerry County Council through Healthy Kerry.  A dedicated committee of local support services and organisations came together to plan a series of 49 events to celebrate World Mental Health Day on the 10th October.
                        </p>
                        <p class="mb-4">
                            Since beginning in 2018 the Fest has been run annually every October and the key focus has been on creating awareness of, and scheduling events that empower people to engage with the ‘Five Ways to Wellbeing’
                            <strong>(Connect | Give | Take Notice | Keep Learning | Be Active)</strong> as well as raising awareness of the available supports and services in the county.
                        </p>
                        <p class="mb-4">
                            An aim of the Fest is that there is something for everyone – from runs to walks, arts & crafts to indoor bowls, coffee mornings to movie nights, workplace wellbeing to parenting information, mindfulness to volunteering information sessions, wellbeing workshops to seminars on grief and loss. The Fest has continued to grow to over 60 free events county-wide and has received very positive feedback from participants and event organisers year-on-year.
                        </p>
                        <p class="mb-4">
                            The Fest plays a central role in promoting a positive sense of wellbeing and has highlighted mental health services and supports which are available in the county. We would like to encourage the Kerry community to take time out to learn, talk, reflect, and engage with others around the topic of mental health and wellbeing, and to reach out and avail of the supports and services available when needed.
                        </p>
                        <p>
                            The organising committee is a collaboration between Connecting for Life Kerry, Healthy Kerry, Kerry County Council, the HSE, NEWKD, SKDP, Kerry Mental Health Association, Kerry Recreation & Sports Partnership, Kerry Diocesan Youth Service, Jigsaw Kerry, Munster Technological University/Kerry and the Kerry Volunteer Centre.
                        </p>
                    </div>
                </div>
                <div class="grid grid-col-1 lg:grid-cols-3 gap-4 lg:h-[270px]">
                    <a @click="$dispatch('img-modal', {  imgModalSrc: '{{ asset('img/kerry-mental-health-4.jpg') }}', imgModalDesc: 'Picture 1' })" class="cursor-pointer">
                        <img src="{{ asset('img/kerry-mental-health-4.jpg') }}" class="col-span-1 object-cover h-full" alt="">
                    </a>
                    <a @click="$dispatch('img-modal', {  imgModalSrc: '{{ asset('img/kerry-mental-health-4.jpg') }}', imgModalDesc: 'Picture 1' })" class="cursor-pointer">
                        <img src="{{ asset('img/olympians-mental-health-11.jpg') }}" class="col-span-1 object-cover h-full" alt="">
                    </a>
                    <a @click="$dispatch('img-modal', {  imgModalSrc: '{{ asset('img/kerry-mental-health-4.jpg') }}', imgModalDesc: 'Picture 1' })" class="cursor-pointer">
                        <img src="{{ asset('img/kerry-mental-health-5.jpg') }}" class="col-span-1 object-cover h-full" alt="">
                    </a>
                </div>

            </div>


        </div>
    </div>
</x-app-layout>
