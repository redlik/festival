<x-mail::message>
# Hello

Organiser of the event **{{ $event }}** taking place {{ $date }} has sent you the message below:

{!! nl2br($message)  !!}

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
