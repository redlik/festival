<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements hasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $guarded = [];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function attendee()
    {
        return $this->hasMany(Attendee::class);
    }

    public function booked()
    {
        return $this->hasMany(Attendee::class)->where('waiting_status','=', false);
    }

    public function waiting()
    {
        return $this->hasMany(Attendee::class)->where('waiting_status','=', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organiser()
    {
        return $this->hasOneThrough(Organiser::class, User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'published')
            ->orderBy('start_date', 'asc')
            ->orderBy('start_time', 'asc');
    }

    public function cover()
    {
        return $this->getFirstMedia('default', ['cover' => 'yes']);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover')
            ->useDisk('covers')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232);
    }

    public function document()
    {
        return $this->belongsToMany(Document::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
