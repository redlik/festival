<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;

class BookingDateForm extends Component
{
    public $booking_start_date;

    public function mount() {
      $this->booking_start_date = json_decode(Setting::where('setting_name', 'booking_start_date')->first()->setting_value) ?? date('d-m-Y');
      ray($this->booking_start_date);
    }
    public function render()
    {
        return view('livewire.booking-date-form');
    }

  public function save()
  {
    $this->booking_start_date = Setting::updateOrCreate(
      ['setting_name' => 'booking_start_date'],
      ['setting_value' => json_encode($this->booking_start_date)]
    );
    }
}
