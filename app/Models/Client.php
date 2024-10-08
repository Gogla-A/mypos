<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    protected $casts = [
        'phone' => 'array'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
