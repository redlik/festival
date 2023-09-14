<x-mail::message>
# Hello

Thank you for signing up for **{{ $event->name }}** event on {{ $event->start_date }}!

This event is fully booked, but you have been added to the waiting list. The event organiser will contact you directly if a space for the event becomes available.

<x-mail::button :url="$url">
Event details
</x-mail::button>

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
