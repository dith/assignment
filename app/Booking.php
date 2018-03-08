<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';
    public $timestamps = false;

    protected $fillable = ['created_at_local', 'driver_id', 'passenger_id', 'state', 'country_id', 'fare'];
    //
    
    public static $commissionRate = 0.2;
    const RIDE_COMPLETED = 'COMPLETED';
    const RIDE_CANCELLED_BY_PASSENGER = 'CANCELLED_PASSENGER';
    const RIDE_CANCELLED_BY_DRIVER = 'CANCELLED_DRIVER';

}
