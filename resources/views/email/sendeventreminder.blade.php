<x-mail::message>
# Hello

We'd like to remind you that on {{ $event->start_date }} at {{ $event->start_time }} the event {{ $event->name }} will take place.

<x-mail::button :url="$url">
View Event Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
