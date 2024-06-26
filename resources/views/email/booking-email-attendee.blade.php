<x-mail::message>
# Thank you for the booking

Thank you for participating in Kerry Mental Health & Wellbeing Fest, below are the details of your booking:

**Booking No:** {{ date("Y") }} / {{ $booking->id }}

**Event:** {{ $event->name }} on {{ $event->start_date }} at {{ $event->start_time }}

@if($event->type != 'online')
**Venue:** {{ $event->venue->name }}, {{ $event->venue->town }}{{ $event->venue->eircode ? ', '.$event->venue->eircode : '' }}
@endif

**People booked for the event:**
@foreach($names as $key => $value)
* {{ $value }}
@endforeach

<x-mail::button :url="$url">
View event
</x-mail::button>

To cancel your booking click here: <a href="{{ route('booking.cancel', $booking->long_id) }}">Cancel booking</a>

Please be mindful that the Fest would simply not be possible without kind people all over Kerry who generously donate their time, energy and expertise to host events for free. As such in the spirit of respect, **please cancel in advance of the event if you cannot make it**. Often events will have waiting lists with people keen to take a spot!

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
