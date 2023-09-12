<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event()
    {
        return $this->belongsToMany(Event::class);
    }

    public function getEventsAttribute()
    {
        return count($this->event);
    }

}
