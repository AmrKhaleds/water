<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFreeze extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_area',
        'to_area',
        'price',
        'status',
        'created_by',
        'time',
        'client_id',
        'note_canceled',
        'assign_at',
        'assign_car_id',
        'driver_id',
        'vehicle_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'client_id');
    }

    public function ToArea()
    {
        return $this->belongsTo('App\Models\Area', 'to_area');
    }

    public function FromArea()
    {
        return $this->belongsTo('App\Models\Area', 'from_area');
    }

    public function assign()
    {
        return $this->belongsTo('App\Models\AssignCar', 'vehicle_id', 'vehicle_id')->latest();
    }

}
