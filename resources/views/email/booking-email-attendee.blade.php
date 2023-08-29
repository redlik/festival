<x-mail::message>
# Thank you for the booking

Thank you for participating in Kerry Mental Health & Wellbeing Fest, below are the details of your booking:

**Event:** {{ $event->name }} on {{ $event->start_date }} at {{ $event->start_time }}

**People booked for the event:**
@foreach($names as $key => $value)
* {{ $value }}
@endforeach

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
