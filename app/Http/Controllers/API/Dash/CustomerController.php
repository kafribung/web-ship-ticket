<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\CustomerResource;
use App\Models\{Customer, Vehicle};

class CustomerController extends Controller
{
    // Read
    public function __invoke()
    {
        $customers = Customer::with('service', 'schedule', 'vehicle')->where('status', 1)->latest()->paginate(50);
        return CustomerResource::collection($customers);    
    }
}
