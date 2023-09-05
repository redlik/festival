<x-mail::message>
# New registration for {{ $event->name }} event

Hello,

Somebody booked for your event.

Number of places booked - {{ $person }}

<x-mail::button :url="''">
View Event
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
