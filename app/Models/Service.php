<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    // Timestamps
    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    // Relation one to many (Customer)
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
