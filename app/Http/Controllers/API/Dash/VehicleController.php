<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __invoke()
    {
        $vehicles = Vehicle::get(['id', 'type']);
        return VehicleResource::collection($vehicles);
    }
}
