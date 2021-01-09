<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Read
    public function index()
    {
        $schedules = Schedule::get();
        return ScheduleResource::collection($schedules);
    }

    // Store
    public function store()
    {
        $data =  request()->validate([
            'ship'      => 'required|string|min:5|max:30',
            'departure' => 'required|string|min:3|max:30',
            'destination' => 'required|string|min:3|max:30',
            'date'      => 'required|date'
        ]);
        Schedule::create($data);
        return response()->json([ "message" => "The item was created successfully"], 201);
    }

    // Show
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return ScheduleResource::make($schedule);
    }

    // Update
    public function update($id)
    {
        $schedule = Schedule::findOrFail($id);
        $data =  request()->validate([
            'ship'      => 'required|string|min:5|max:30',
            'departure' => 'required|string|min:3|max:30',
            'destination' => 'required|string|min:3|max:30',
            'date'      => 'required|date'
        ]);   
        $schedule->update($data);
        return ScheduleResource::make($schedule);
    }

    
}
