<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\DashboardResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $data = Auth::user();
        $data['count'] = User::where('role', 1)->count();
        return DashboardResource::make($data);
    }
}
