<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    // Timestamps
    public $timestamps = false;

    protected $guarded = [
        'id'
    ];
}
