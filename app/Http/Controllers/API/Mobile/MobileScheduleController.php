<?php

namespace App\Http\Controllers\API\Mobile;

use App\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\ScheduleResource;

class MobileScheduleController extends Controller
{
    public function __invoke()
    {
        $schedules = Schedule::orderBy('id', 'desc')->get();
        return ScheduleResource::collection($schedules);
    }
}
