<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function address(): string
    {
        $address = $this->name. ' ' . $this->address1 . ' ' . $this->street . ' ' . $this->town . ' ' . $this->county . ' ' . $this->eircode;

        return preg_replace('/\s+/', '+', $address);
    }
}
