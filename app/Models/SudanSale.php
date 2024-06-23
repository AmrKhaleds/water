<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SudanSale extends Model
{
    use HasFactory;

    protected $table ='sudan_sales';

    protected $fillable = [
        'client_name',
        'client_phone',
        'client_whatsapp',
        'quantity',
        'company_name',
        'purchase_price',
        'sale_price',
        'expenses',
        'notes',
        'net_profit',
        'purchase_date',
        'product_id',
        'goods_received_date',
        'goods_received',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
