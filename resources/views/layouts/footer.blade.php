<div class="bg-gray-700 py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-wrap items-top text-gray-100">
        <div class="w-full md:w-1/3 px-4">
            <img class="block h-24 w-auto mb-2" src="{{ asset('img/logo-white.svg') }}" alt="kerry fest footer logo">
            <div>
                <div class="font-medium mt-4">Follow us on social media</div>
                <div class="flex">
                    <a href="https://www.facebook.com/Kerry-MHW-fest-100210156103740" target="_blank">
                        <i class="fa-brands fa-facebook-square text-gray-100 hover:text-yellow-300 mr-4"></i>
                    </a>
                    <a href="https://www.instagram.com/kerrymhwfest/" target="_blank">
                        <i class="fa-brands fa-instagram-square text-gray-100 hover:text-yellow-300 mr-4"></i>
                    </a>
                    <a href="https://twitter.com/KerryMHWfest" target="_blank">
                        <i class="fa-brands fa-twitter-square text-gray-100 hover:text-yellow-300"></i>
                    </a>
                </div>
            </div>
            <ul class="text-gray-200 text-sm mt-2">
                <li class="mb-2"><span class="inline-block w-16 font-bold">Email:</span>
                    <a href="mailto:kerrymhwfest20@gmail.com ">kerrymhwfest20@gmail.com </a></li>
            </ul>
        </div>
        <div class="w-full md:w-1/3 px-4">
            <div class="font-bold text-gray-200 mb-4 mt-8 md:mt-0">Navigation</div>
            <ul class="text-sm list-disc pl-4">
                <li class="mb-2"><a href="{{ route('events') }}">Events</a></li>
                <li class="mb-2"><a href="{{ route('login') }}">Log in</a></li>
                <li class="mb-2"><a href="{{ route('pages.join-us') }}">Organiser Registration</a></li>
            </ul>
        </div>
        <div class="w-full md:w-1/3 px-4">
            <div class="font-bold text-gray-200 mb-4 mt-8 md:mt-0">Customer service</div>
            <ul class="text-sm list-disc pl-4">
                <li class="mb-2"><a href="{{ route('pages.contact') }}">Contact us</a></li>
                <li class="mb-2"><a href="{{ route('pages.about') }}">About</a></li>
                <li class="mb-2"><a href="">Terms & Conditions</a></li>
                <li class="mb-2"><a href="">Privacy Policy</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="bg-gray-900 flex text-gray-100 text-sm py-2">
    <div class="max-w-7xl mx-auto flex justify-between text-gray-300 text-sm">
        <div>© All rights reserved - </div>
        <div>&nbspCollage Creative {{ now()->year }}</div>
    </div>
</div>
