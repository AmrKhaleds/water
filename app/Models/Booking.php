<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'filling_period',
        'first_day_packing',
        'from_area',
        'near',
        'packing_number',
        'price',
        'time',
        'from_address',
        'status',
        'created_by'
        /*
        'client_id',
        'filling_period',
        'gallon_type',
        'first_day_packing',
        'from_area',
        'price',
        'type',
        'packing_number',
        'gallon_count',
        'time',
        'from_address',
        'status',
        'created_by'
        */
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'client_id');
    }
    public function bill()
    {
        return $this->belongsTo('App\Models\Bill', 'bill_id');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'from_area');
    }

    public function assign()
    {
        return $this->belongsTo('App\Models\AssignCar', 'vehicle_id', 'vehicle_id')->latest();
    }

    public function rate()
    {
        return $this->belongsTo('App\Models\Rate', 'id', 'booking_id');
    }
}
