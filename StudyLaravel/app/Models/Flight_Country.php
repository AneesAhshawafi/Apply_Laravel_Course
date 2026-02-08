<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight_Country extends Model
{
    protected $table='flight_countries';
    protected $fillable = ['destination','flight_id'];
}
