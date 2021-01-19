<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\CustomerResource;
use App\Models\{Customer, Vehicle};

class CustomerController extends Controller
{
    // Read
    public function index()
    {
        $customers = Customer::with('service', 'schedule', 'vehicle')->latest()->get();
        return CustomerResource::collection($customers);    
    }
    // Store
    public function store()
    {
        $data = request()->validate([
            'name'    => ['required', 'string', 'min:3', 'max:30'],
            'identity'=> ['required', 'string', 'min:8', 'max:17'],
            'age'     => ['required', 'max:3'],
            'city'    => ['required', 'string', 'min:3', 'max:20'],
            'gender'  => ['required', 'string', 'min:4', 'max:6'],
            'schedule'=> ['required'],
            'service' => ['required'],
        ]);

        $data['schedule_id'] = request('schedule');
        $data['service_id']  = request('service');

        // Budeget Orang
        if (request('age')  >= 17) {
            $data['budget'] = 24000;
        } else $data['budget'] = 11000;

        // Budget Kendaraaan
        if (request('service') == 2) {
            $data['vehicle_id'] = request('vehicle');
            $biayaKendaraan     = Vehicle::findOrFail($data['vehicle_id']);
            $data['budget']     = $biayaKendaraan->budget + $data['budget'];
        } else $data['vehicle_id'] = null;
        Customer::create($data);
        return response(['message' => 'The item was created successfully'], 201);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json([ "message" => "The item was delete successfully"], 204);
    } 
}
