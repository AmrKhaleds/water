<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'area_id',
        'vehicle_id',
        'address',
        'type_store',
    ];


    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle','vehicle_id');
    }
}
