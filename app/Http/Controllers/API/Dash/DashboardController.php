<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\DashboardResource;
use App\Models\{Customer, Schedule, User};
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $data = Auth::user();
        $data['admin']    = User::where('role', 1)->count();
        $data['schedule'] = Schedule::count();
        $data['booking']  = Customer::where('status', 0)->count();
        $data['customer']  = Customer::where('status', 1)->count();
        return DashboardResource::make($data);
    }
}
