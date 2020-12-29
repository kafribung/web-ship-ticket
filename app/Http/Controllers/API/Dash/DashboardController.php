<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\DashboardResource;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $admin = User::where('role', 0)->count();
        // $data['admin'] = $admin;
        $data = request()->user();
        return DashboardResource::make($data);
    }
}
