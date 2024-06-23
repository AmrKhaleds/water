<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'statements',
        'notes'
    ];
}
