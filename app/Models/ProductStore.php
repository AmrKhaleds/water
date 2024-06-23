<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'store_id',
        'qty',
    ];


    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function store()
    {
        return $this->belongsTo('App\Models\Store','store_id');
    }

}
