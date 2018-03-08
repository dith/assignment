<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $primaryKey = 'driver_id';
    public $timestamps = false;

    protected $fillable = ['name', 'phone_number', 'email']; 


    //
}
