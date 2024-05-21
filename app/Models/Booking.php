<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'event_id',
        'long_id'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['long_id'];
    }


}
