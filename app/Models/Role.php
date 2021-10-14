<?php
namespace App\Models;

use Trebol\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name',
        'display_name',
        'description',

    ];

    // public function user()
    // {
    // 	return $this->belongsTo(User::class);
    // }
}
