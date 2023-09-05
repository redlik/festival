@component('mail::message')
# Cancellation of {{ $event->name }} on {{ \Carbon\Carbon::parse($event->start_date)->format('d M y') }}

We regret to inform you that {{ $event->name }} being hosted by {{ $event->user->organiser->name }} on {{ \Carbon\Carbon::parse($event->start_date)->format('d M y') }} at {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} has been cancelled.

We apologise for any inconvenience caused. We hope you can find an alternative event(s) to attend that is of interest. Click below to check the schedule of events.

Thanks for your interest in the Kerry Mental Health & Wellbeing Fest.


@component('mail::button', ['url' => $url])
Festival Events
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
