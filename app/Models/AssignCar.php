<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCar extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'delegate_id',
        'counter_number',
        'description',
        'created_by',
        'updated_by',
        'vehicle_id',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function delegate()
    {
        return $this->belongsTo('App\Models\User','delegate_id');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle','vehicle_id');
    }

}
