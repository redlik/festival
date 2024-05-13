<?php

namespace App\Livewire;

use App\Mail\BookingCancelledByAttendee;
use App\Models\Attendee;
use Livewire\Component;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class BookingList extends Component
{
    public $bookings;

    public $events;

    public $message;

    public $waiting_only = false;

    public $uniques;

    public $filter = '';

    public $dropdown;

    public function cancelBooking($booking)
    {
        $attendee = Attendee::find($booking);
        if($attendee->waiting_status) {
            $this->message = 'The waiting list entry has been removed';
        } else {
            $this->message = 'The booking entry has been removed';
        }
        $event = Event::where('id', $attendee->event_id)->first();
        $organiser = User::where('id', $attendee->event->user_id)->first();
        Mail::to($organiser)->send(new BookingCancelledByAttendee($event, $attendee));
        $attendee->delete();

        session()->flash('cancelled', $this->message);
    }
    public function render()
    {
        $this->bookings = Attendee::where('user_id',Auth::user()->id)
            ->when($this->filter != '', function($q){
                return $q->where('event_id', $this->filter);
            })
            ->when($this->waiting_only, function ($w) {
                return $w->where('waiting_status', 1);
            })
            ->orderBy('event_id', 'asc')
            ->with('event')->get();
        $this->dropdown = Attendee::where('user_id',Auth::user()->id)->get();
        $this->uniques = array_unique($this->dropdown->pluck('event_id')->toArray());
        $this->events = Event::whereIn('id', $this->uniques)->orderBy('name', 'asc')->get();

        return view('livewire.booking-list');
    }
}
