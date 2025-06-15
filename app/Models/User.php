<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: user bisa mendaftar banyak event
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Shortcut: event-event yang didaftarkan user (melalui tabel bookings)
    public function events()
    {
        return $this->belongsToMany(Event::class, 'bookings')->withTimestamps();
    }

    // Di User.php
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bookmarks()
    {
        return $this->belongsToMany(Event::class, 'bookmarks')->withTimestamps();
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function likes()
    {
        return $this->belongsToMany(Event::class, 'likes')->withTimestamps();
    }

}
