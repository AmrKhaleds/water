<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;


    protected $fillable = [
        'ref',
        'set_date',
        'user_id',
        'store_id',
        'type',
        'status',
        'sub_total',
        'tax',
        'tax_amount',
        'total_amount',
        'due',
        'created_by',
        'description',
    ];


    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    public function fromStore()
    {
        return $this->belongsTo('App\Models\Store', 'user_id');
    }
    public function toStore()
    {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    public function assign()
    {
        return $this->belongsTo('App\Models\AssignCar', 'vehicle_id', 'vehicle_id')->latest();
    }

}
