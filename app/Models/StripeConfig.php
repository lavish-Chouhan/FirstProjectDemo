<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_key',
        'stripe_secret'
    ];
}
