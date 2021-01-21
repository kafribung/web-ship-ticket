<?php

namespace App\Http\Controllers\API\Mobile;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\BookingRequest;
use App\Jobs\MobileBookingStoreJob;

class MobileBookingController extends Controller
{
    public function __invoke(BookingRequest $request)
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

        MobileBookingStoreJob::dispatch($data);
        return response(['message' => 'The item was created successfully'], 201);
    }
}
