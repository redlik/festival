<?php

namespace App\Livewire;

use App\Models\Attendee;
use App\Models\Booking;
use Livewire\Component;

class BookingCancellationPanel extends Component
{
    public Booking $booking;

    public $attendees;

    public $message;

    public function render()
    {
        $this->attendees = Attendee::where('booking_id', $this->booking->id)->with('event')->get();
        return view('livewire.booking-cancellation-panel');
    }

    public function cancelOneBooking($attendeeToDelete)
    {
        $attendeeToDelete = Attendee::findOrFail($attendeeToDelete);
        $attendeeToDelete->delete();
        $this->message = "One attendee has been removed from the booking";
    }

    public function cancelEntireBooking($bookingToDelete)
    {
        $bookingToDelete = Booking::findOrFail($bookingToDelete);
        $attendeesToDelete = Attendee::where('booking_id', $bookingToDelete->id)->get();
        foreach ($attendeesToDelete as $attendeeToDelete) {
            $attendeeToDelete->delete();
        }
        $bookingToDelete->delete();
        $this->message = "Entire booking has been cancelled";
        return redirect()->route('events');
    }
}
