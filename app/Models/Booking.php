<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

class Booking extends Model
{
    use HasFactory;

    /**
     * Table name
     */
    protected $table = 'bookings';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        // Relationship
        'user_id',
        'event_id',

        // Booking Reference
        'booking_id',

        // Customer Information
        'first_name',
        'last_name',
        'full_name',
        'email',
        'country_code',
        'contact',

        // Schedule
        'booking_datetime',
        'end_datetime',

        // Booking Details
        'guests',
        'room_type',

        // Additional Information
        'notes',
        'receipt',
    ];

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Event relationship
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Format customer name
     */
    public function getCustomerNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Date formatting
     */
    protected function casts(): array
    {
        return [
            'booking_datetime' => 'datetime',
            'end_datetime' => 'datetime',
        ];
    }
}