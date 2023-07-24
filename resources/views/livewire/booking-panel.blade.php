<div>
    @php
        $full = false;

    @endphp
    @if($event->is_private)
        <div class="bg-gray-100 rounded border border-gray-300 text-gray-600 italic p-6 mt-8">
            Please note this is a private event that is not open to the public.
        </div>
    @else
        <div class="bg-gray-100 rounded border border-gray-300 p-6 mt-8">
            @auth
                @if($event->start_date < \Carbon\Carbon::now())
                    <h5 class="text-gray-600">The registrations for this event are now closed.</h5>
                @else
                    @if($event->limited != 0)
                        @if($event->attendees <= $event->attendee_count)
                            <div>
                                <h5 class="bg-red-100 rounded px-3 py-1 text-red-600 shadow font-medium">The event is fully booked, but you can still enroll into a waiting list below.</h5>
                                @php
                                    $full = true;
                                @endphp
                            </div>
                        @else
                            <h4 class="text-gray-600">Please fill in your details below to register for this event.</h4>
                            <div>
                                {{ $event->attendees - $event->attendee_count }} places left
                            </div>
                        @endif
                    @else
                        <h4 class="text-gray-600">Please fill in your details below to register for this event.</h4>
                    @endif

                    @if(\Session::has('registered'))
                        <div class="bg-gray-700 border border-gray-300 text-gray-100 p-2 rounded mt-4">
                            {{ \Session::get('registered') }}
                        </div>
                    @endif

                    <div class="my-6">
                        @if ($errors->any())
                            <div class="bg-red-200 rounded border border-red-400 px-4 py-2 my-2">
                                <ul class="list-none list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-700 font-semibold">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="my-4 w-full">

                                @if($places_left >= 6 || $event->limited == 0)
                                    @php
                                        $number = 6;
                                    @endphp
                                @else
                                    @php
                                        $number = $places_left;
                                    @endphp
                                @endif
                                    <form wire:submit.prevent="tickets">
                                        <select wire:model.defer="tickets" id='number' class="focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md mr-4">
                                            @for($i = 1; $i <= $number; $i++)
                                                <option value="{{ $i }}">{{ $i }} {{ Str::plural('person', $i) }}</option>
                                            @endfor
                                        </select>
                                        <button class="button-primary">Book places</button>
                                        <label for="number" class="text-sm block mt-2 font-bold">Number of places you wish to book @json( (int) $tickets)</label>
                                    </form>



                            </div>

                        <form wire:submit.prevent="register">
                            @honeypot
                            @if($full)
                                <input type="hidden" wire:model="waiting" value="1">
                            @endif
                            @for($j = 1; $j <= $people; $j++)
                                <div class="lg:flex items-start mb-6">
                                    <div class="grow mr-4 mb-4 md:mb-0">
                                        <div class="mt-1">
                                            <input type="text" wire:model="names.name-{{ $j }}" id="name-{{ $j }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" value={{ Auth::user()->name }}>
                                        </div>
                                        <label for="name-{{ $j }}" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Name</label>
                                    </div>
                                    <div class="grow mr-4 mb-4 md:mb-0">
                                        <div class="mt-1">
                                            <input type="tel" wire:model="names.phone-{{ $j }}" id="phone-{{ $j }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="066 888 8888">
                                        </div>
                                        <label for="phone-{{ $j }}" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Phone</label>
                                    </div>
                                    <div class="grow mr-4 mb-4 md:mb-0">
                                        <div class="mt-1">
                                            <input type="email" wire:model="names.email-{{ $j }}" id="email-{{ $j }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com">
                                        </div>
                                        <label for="email-{{ $j }}" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Email</label>
                                    </div>
                                </div>
                            @endfor
                            <div class="pt-1">
                                @if($full)
                                    <button class="button-primary" aria-label="Add to waiting list">
                                        ADD TO WAITING LIST
                                    </button>
                                @else
                                    <button class="button-primary" aria-label="Register as participant">
                                        REGISTER
                                    </button>
                                @endif

                            </div>


                            <div class="mt-6 bg-gray-200 rounded p-2">
                                <input type="checkbox" wire:model="optin" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2">
                                <label for="opt_in" class="font-medium text-gray-700">I agree to be contacted in future about the upcoming events.</label>
                            </div>
                        </form>
                        <div class="text-gray-500 text-sm mt-4">
                            Your personal details won't be shared with anyone unauthorised. We only use it if the organiser of the event make some changes, like changing times, cancelling etc.
                        </div>
                    </div>
                @endif
            @endauth
            @guest
                <div class="text-gray-600 font-medium">
                    The registration for the event require a booking account, please register your <a href="{{ route('pages.split') }}#registration-form" class="font-bold hover:underline">account
                        here</a>, or <a href="{{ route('login') }}" class="font-bold hover:underline">login</a> to make a booking.

                </div>
            @endguest

        </div>
    @endif
</div>
