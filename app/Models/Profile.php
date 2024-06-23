<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'from_area');
    }
}
