<x-mail::message>
# Hello

Just a little reminder that our upcoming event **{{ $event->name }}** on **{{ $event->start_date }}** at **{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}** is only three days away.

@if($venue)
## Event location
{{ $venue->name }}<br>
{{ $venue->address1 }}<br>
{{ $venue->town }}, {{ $venue->eircode }}
@else
**This is an online event**
@endif

<x-mail::button :url="$url">
View Event Details
</x-mail::button>

**If you cannot attend your event, please cancel your registration as soon as possible, so that the facilitator is aware and your space can be filled.**<br>
**To cancel your booking click here: <a href="{{ route('booking.cancel', $booking->long_id) }}">Cancel booking</a>**

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
