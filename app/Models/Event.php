<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'start_date',
        'end_date',
        'max_tickets',
        'image',
        'user_id',
        'start_time', 
        'end_time',
        'sk', 
        'harga', 
        'pemateri', 
        'organizer_id'
    ];

     public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Admin yang membuat event
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

}
