<?php

namespace Tests\Feature;

use App\Jobs\EventReminderJob;
use App\Mail\SendEventReminder as SendEventReminderMail;
use App\Models\Attendee;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EventReminderTest extends TestCase
{
    use RefreshDatabase;

    private function createEventWithAttendee(int $daysFromNow, bool $waitingStatus = false): array
    {
        $user = User::factory()->create();

        $event = Event::create([
            'name' => 'Test Event',
            'slug' => 'test-event-' . $daysFromNow . '-' . uniqid(),
            'start_date' => Carbon::now()->addDays($daysFromNow)->format('Y-m-d'),
            'start_time' => '10:00:00',
            'description' => 'Test description',
            'type' => 'online',
            'user_id' => $user->id,
        ]);

        $booking = Booking::create(['event_id' => $event->id]);

        $attendee = Attendee::create([
            'name' => 'Test Attendee',
            'email' => 'attendee@example.com',
            'event_id' => $event->id,
            'booking_id' => $booking->id,
            'waiting_status' => $waitingStatus,
        ]);

        return [$event, $booking, $attendee];
    }

    public function test_reminder_jobs_dispatched_for_events_seven_days_away(): void
    {
        Queue::fake();

        [$event, , $attendee] = $this->createEventWithAttendee(7);

        $this->artisan('app:send-event-reminder');

        Queue::assertPushed(EventReminderJob::class, function ($job) use ($attendee, $event) {
            return $job->attendeeEmail === $attendee->email
                && $job->event->id === $event->id
                && $job->daysUntil === 7;
        });
    }

    public function test_reminder_jobs_dispatched_for_events_three_days_away(): void
    {
        Queue::fake();

        [$event, , $attendee] = $this->createEventWithAttendee(3);

        $this->artisan('app:send-event-reminder');

        Queue::assertPushed(EventReminderJob::class, function ($job) use ($attendee, $event) {
            return $job->attendeeEmail === $attendee->email
                && $job->event->id === $event->id
                && $job->daysUntil === 3;
        });
    }

    public function test_reminder_jobs_dispatched_for_events_one_day_away(): void
    {
        Queue::fake();

        [$event, , $attendee] = $this->createEventWithAttendee(1);

        $this->artisan('app:send-event-reminder');

        Queue::assertPushed(EventReminderJob::class, function ($job) use ($attendee, $event) {
            return $job->attendeeEmail === $attendee->email
                && $job->event->id === $event->id
                && $job->daysUntil === 1;
        });
    }

    public function test_waiting_list_attendees_do_not_receive_reminders(): void
    {
        Queue::fake();

        $this->createEventWithAttendee(7, waitingStatus: true);

        $this->artisan('app:send-event-reminder');

        Queue::assertNothingPushed();
    }

    public function test_no_jobs_dispatched_when_no_upcoming_events(): void
    {
        Queue::fake();

        $this->artisan('app:send-event-reminder');

        Queue::assertNothingPushed();
    }

    public function test_reminder_email_is_sent_to_attendee(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $event = Event::create([
            'name' => 'Test Event',
            'slug' => 'test-event',
            'start_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'start_time' => '10:00:00',
            'description' => 'Test description',
            'type' => 'online',
            'user_id' => $user->id,
        ]);
        $booking = Booking::create(['event_id' => $event->id]);

        EventReminderJob::dispatch('attendee@example.com', $event, $booking, 7);

        Mail::assertSent(SendEventReminderMail::class, function ($mail) use ($event) {
            return $mail->hasTo('attendee@example.com')
                && $mail->event->id === $event->id
                && $mail->daysUntil === 7;
        });
    }

    public function test_reminder_email_not_sent_when_attendee_email_is_empty(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $event = Event::create([
            'name' => 'Test Event',
            'slug' => 'test-event',
            'start_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'start_time' => '10:00:00',
            'description' => 'Test description',
            'type' => 'online',
            'user_id' => $user->id,
        ]);
        $booking = Booking::create(['event_id' => $event->id]);

        EventReminderJob::dispatch('', $event, $booking, 7);

        Mail::assertNothingSent();
    }
}
