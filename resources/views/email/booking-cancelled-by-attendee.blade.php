<x-mail::message>
# Dear Organiser

@if($attendee->waiting_status)
**{{ $attendee->name }}** has removed their waiting status entry from your event: **{{ $event->name }}** on **{{ $event->start_date }}**
@else
**{{ $attendee->name }}** has cancelled their booking place for the following event: **{{ $event->name }}** on **{{ $event->start_date }}**
@endif

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
