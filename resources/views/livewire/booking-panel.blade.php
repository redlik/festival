<div class="mt-8 lg:mt-16">
    @if($event->is_private)
        <div class="bg-gray-100 rounded border border-gray-300 text-gray-600 italic p-6 mt-8">
            Please note this is a private event that is not open to the public.
        </div>
    @else
        <div class="bg-gray-100 rounded border border-gray-300 p-6 mt-8">
            @auth
                @if(\Session::has('registered'))
                    <div class="bg-green-100 border border-green-500 text-green-700 p-2 font-semibold rounded mb-6">
                        {{ \Session::get('registered') }}
                    </div>
                @endif

                @if($event->start_date < \Carbon\Carbon::now())
                    <h5 class="text-gray-600">The registrations for this event are now closed.</h5>
                @else
                    @if($event->limited != 0)
                        @if($full)
                            <div>
                                <h5 class="bg-red-100 rounded px-3 py-1 text-red-600 shadow font-medium">The event is now fully booked, but you can still enroll into a waiting list below.</h5>
                            </div>
                        @else
                            <h4 class="text-gray-600">Please fill in your details below to register for this event.</h4>
                            <div class="px-4 py-1 mt-2 rounded-full bg-gray-300 text-olive-600 border border-olive-600 inline-block font-bold">
                                {{ $places_left }} {{ \Illuminate\Support\Str::of('place')->plural($places_left)}} left
                            </div>
                        @endif
                    @else
                        <h4 class="text-gray-600">Please fill in your details below to register for this event.</h4>
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
                            <div class="mt-4 mb-4 w-full">
                                @if(! $full)
                                    <div class="flex items-center mb-4">
                                    <div>
                                        <button class="{{ $disabled_minus ? 'cursor-not-allowed' : 'cursor-pointer' }}" wire:click="minus">
                                            <i class="fa-solid fa-circle-minus text-xl {{ $disabled_minus ? 'text-olive-300' : 'text-olive-600' }}"></i>
                                        </button>
                                    </div>
                                    <div class="text-3xl font-bold text-olive-700 px-4">
                                        {{ $tickets }}
                                    </div>
                                    <div>
                                        <button class="{{ $disabled_plus ? 'cursor-not-allowed' : 'cursor-pointer' }}" wire:click="plus">
                                            <i class="fa-solid fa-circle-plus text-xl {{ $disabled_plus ? 'text-olive-300' : 'text-olive-600' }}"></i>
                                        </button>
                                    </div>
                                    <div class="ml-4 text-olive-600 text-sm font-semibold">
                                        Select number of places you wish to book (max 6 per person)
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="mb-2 text-sm font-bold text-gray-600">
                                One row per one person, do not insert multiple names into one field. The registration will still count
                                <span class="underline">as one</span>.
                            </div>
                            <div class="mb-2 text-sm text-olive-400">
                                If you are booking places on behalf of somebody you can add their phone or email below, otherwise we will save your login details with them.
                            </div>

                        <form wire:submit="register">
                            @honeypot
                            @if($full)
                                <input type="hidden" wire:model.live="waiting_status" value="1">
                            @endif
                            @for($j = 1; $j <= $tickets; $j++)
                                <div class="lg:flex items-start mb-6">
                                    <div class="grow mr-4 mb-4 md:mb-0">
                                        <div class="mt-1">
                                            <input type="text" wire:model.live="names.name-{{ $j }}" id="name-{{ $j }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                        </div>
                                        <label for="name-{{ $j }}" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Name <span class="text-red-700">*</span></label>
                                    </div>
                                    <div class="grow mr-4 mb-4 md:mb-0">
                                        <div class="mt-1">
                                            <input type="email" wire:model.live="names.email-{{ $j }}" id="email-{{ $j }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com"
                                            @if($full)
                                                required
                                            @endif>
                                        </div>
                                        <label for="email-{{ $j }}" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Email
                                            {{ $full ? '(required)' : '(optional)' }}
                                        </label>
                                    </div>
                                    <div class="grow mr-4 mb-4 md:mb-0">
                                        <div class="mt-1">
                                            <input type="tel" wire:model.live="names.phone-{{ $j }}" id="phone-{{ $j }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="066 888 8888">
                                        </div>
                                        <label for="phone-{{ $j }}" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Phone (optional)</label>
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


                            <div class="mt-6">
                                <input type="checkbox" wire:model.live="optin" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2">
                                <label for="opt_in" class="font-medium text-gray-700">I agree to be contacted in future about the upcoming events.</label>
                            </div>
                        </form>
                        <div class="text-gray-500 text-sm mt-4">
                            Your personal details won't be shared with anyone unauthorised. We only use it if the organiser of the event makes some changes, such as changing dates & times, cancelling etc.
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
