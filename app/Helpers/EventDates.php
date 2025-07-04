<?php

namespace App\Helpers;

use App\Models\Event;
use Illuminate\Support\Facades\Cache;

class EventDates
{
  public static function getEventsDates() : array
  {
    if (!Cache::has('events_dates')) {
      $events_dates = Event::selectRaw('YEAR(start_date) as year')
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year')
        ->toArray();
      Cache::put('events_dates', $events_dates, now()->addDays(30));
    } else {
      $events_dates = Cache::get('events_dates');
    }

    return $events_dates;
  }

  /**
   * Get all distinct event dates
   *
   * @return array
   */
  public function getEventsFullDates() : array
  {
    return $events_dates = Event::select('start_date')
      ->distinct()
      ->get()
      ->toArray();
  }
}
