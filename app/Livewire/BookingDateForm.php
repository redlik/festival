<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Setting;

class BookingDateForm extends Component
{
    public $booking_start_date;
    public $update;

    public function mount() {
      $this->booking_start_date = json_decode(Setting::where('setting_name', 'booking_start_date')->first()->setting_value) ?? date('d-m-Y');
    }
    public function render()
    {
        return view('livewire.booking-date-form');
    }

  public function save()
  {
    if($this->booking_start_date < Carbon::now()) {
      $this->update = "The booking date cannot be earlier than today";
    } else {
      Setting::updateOrCreate(
        ['setting_name' => 'booking_start_date'],
        ['setting_value' => json_encode($this->booking_start_date)]
      );
      $this->update = "Booking start date updated";
    }

  }

}
