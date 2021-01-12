<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'crated_at',
        'updated_at'  
    ];

    // Relation many to one (Customer)
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relation many to one (Customer)
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
