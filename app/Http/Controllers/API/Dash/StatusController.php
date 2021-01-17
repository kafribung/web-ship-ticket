<?php

namespace App\Http\Controllers\API\Dash;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\CustomerResource;

class StatusController extends Controller
{
    public function __invoke(Customer $customer)
    {
        $customer->update([
            'status' => 1
        ]);
        return CustomerResource::make($customer);    
    }
}
