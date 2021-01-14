<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\CustomerRequest;
use App\Http\Resources\Dash\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Read
    public function index()
    {
        $customers = Customer::with('service', 'schedule', 'vehicle')->get();
        return CustomerResource::collection($customers);    
    }
    // Store
    public function store()
    {
        $data = request()->validate([
            'name'    => ['required', 'string', 'min:3', 'max:30'],
            'identify'=> ['required', 'string', 'min:8', 'max:17'],
            'age'     => ['required', 'min:3'],
            'city'    => ['required', 'string', 'min:5', 'max:20'],
            'gender'  => ['required', 'string', 'min:6'],
            'service' => 'required',
        ]);
        dd($data);
        Customer::create($data);
        return response(['message' => 'The item was created successfully'], 201);
    }
}
