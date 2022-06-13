<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'target' => 'array'
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function attendee(){
        return $this->hasMany(Attendee::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
