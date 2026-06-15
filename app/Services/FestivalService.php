<?php

namespace App\Services;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;
class FestivalService
{
  public static function festival_start_date()
  {
    if (Cache::has('festival_start_date')) {
      return Cache::get('festival_start_date');
    } else {
      $start_date = config('festival.festival_start_date');
      return Cache::remember('festival_start_date', now()->addDays(60), function () use ($start_date) {
        return $start_date;
      });
    }
  }

  public static function festival_end_date()
  {
    if (Cache::has('festival_end_date')) {
      return Cache::get('festival_end_date');
    } else {
      $end_date = config('festival.festival_end_date');
      return Cache::remember('festival_end_date', now()->addDays(60), function () use ($end_date) {
        return $end_date;
      });
    }
  }

  public static function generateDropDownDates()
  {
    $start_date = self::festival_start_date();
    $end_date = self::festival_end_date();

    $period = CarbonPeriod::create($start_date, '1 day', $end_date);

    $datesArray = [];
    foreach ($period as $date) {
      $datesArray[] = $date->format('Y-m-d');
    }
    return $datesArray;
  }
}
