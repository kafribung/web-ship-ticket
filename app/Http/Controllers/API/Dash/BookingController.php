<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\BookingRequest;
use App\Http\Resources\Dash\{BookingResource, CustomerResource};
use App\Models\{Customer, Vehicle};

class BookingController extends Controller
{
    // Read
    public function index()
    {
        $customers = Customer::with('service', 'schedule', 'vehicle')->where('status', 0)->latest()->get();
        return CustomerResource::collection($customers);    
    }
    // Store
    public function store(BookingRequest $request)
    {
        $data = $request->validated();

        $data['schedule_id'] =  $request->schedule;
        $data['service_id']  = $request->service;

        // Budeget Orang
        if ($request->age  >= 17) {
            $data['budget'] = 24000;
        } else $data['budget'] = 11000;

        // Budget Kendaraaan
        if ($request->service == 2) {
            $data['vehicle_id'] = $request->vehicle;
            $biayaKendaraan     = Vehicle::findOrFail($data['vehicle_id']);
            $data['budget']     = $biayaKendaraan->budget + $data['budget'];
        } else $data['vehicle_id'] = null;
        Customer::create($data);
        return response(['message' => 'The item was created successfully'], 201);
    }

    // Show
    public function show(Customer $customer)
    {
        // Tidak bisa menggunakan CustomerResource / ada schedule id yang perlu di get
        // Sedangkan CustomerResource memmuat schedule dalam bentuk object
        return BookingResource::make($customer);
    }

    // Update
    public function update(BookingRequest $request, Customer $customer)
    {
        $data = $request->validated();
        $data['schedule_id'] =  $request->schedule;
        $data['service_id']  = $request->service;

        // Budeget Orang
        if ($request->age  >= 17) {
            $data['budget'] = 24000;
        } else $data['budget'] = 11000;

        // Budget Kendaraaan
        if ($request->service == 2) {
            $data['vehicle_id'] = $request->vehicle;
            $biayaKendaraan     = Vehicle::findOrFail($data['vehicle_id']);
            $data['budget']     = $biayaKendaraan->budget + $data['budget'];
        } else $data['vehicle_id'] = null;
        $customer->update($data);
        return CustomerResource::make($customer);
    }

    // Destroy
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json([ "message" => "The item was delete successfully"], 204);
    } 
}
