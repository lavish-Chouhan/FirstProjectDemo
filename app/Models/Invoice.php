<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class,'invoice_id');
    }

}
