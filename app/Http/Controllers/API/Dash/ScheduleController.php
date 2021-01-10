<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\ScheduleRequest;
use App\Http\Resources\Dash\ScheduleResource;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    // Read
    public function index()
    {
        $schedules = Schedule::orderBy('id', 'desc')->get();
        return ScheduleResource::collection($schedules);
    }

    // Store
    public function store(ScheduleRequest $request)
    {
        $data = $request->validated();
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
    public function update(ScheduleRequest $request ,$id)
    {
        $data = $request->validated();
        $schedule = Schedule::findOrFail($id);
        $schedule->update($data);
        return ScheduleResource::make($schedule);
    }

    // Destroy
    public function destroy($id)
    {
        Schedule::destroy($id);
        return response()->json([ "message" => "The item was delete successfully"], 204);
    }
}
