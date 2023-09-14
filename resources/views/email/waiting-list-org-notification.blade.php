<x-mail::message>
# Hello

Your event - **{{ $event->name }} on {{ $event->start_date }}** is fully booked but someone sign up for the waiting list.

If you manage to find a place, kindly check your attendee list on the Dashboard if you can add more participants.

<x-mail::button :url="$url">
Dashboard
</x-mail::button>

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
