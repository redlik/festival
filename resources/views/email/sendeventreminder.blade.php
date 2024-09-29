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

*If you can't make it, please consider cancelling your booking so other can attend.*

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
