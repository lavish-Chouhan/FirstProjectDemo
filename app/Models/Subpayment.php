<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subpayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_id',
        'subtotal',
        'tax',
        'total'
    ];
}
