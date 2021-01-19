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
            'status' => request('status')
        ]);
        return CustomerResource::make($customer);    
    }
}
