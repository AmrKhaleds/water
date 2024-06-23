<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cost',
        'unit_id',
        'brand_id',
        'alert_stock',
        'sale',
        'notes',
        'photos',
    ];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id','id');
    }
    public function products_store()
    {
        return $this->hasMany('App\Models\ProductStore','product_id','id');
    }

    public function sudanSale()
    {
        return $this->hasMany(SudanSale::class);
    }
}
