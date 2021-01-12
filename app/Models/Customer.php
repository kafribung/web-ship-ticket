<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'  
    ];

    // // Mutator
    // public function getActiveAttribute()
    // {
    //     if ($this->status == 0) {
    //         return 'Belum Lunas';
    //     } else return 'Lunas';
    // }

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

    // Relation many to one (Customer)
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
