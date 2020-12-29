<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke()
    {
        // Get user who requested the logout
        $user = request()->user(); //or Auth::user()
        $user->tokens()->delete();
        Auth::guard('web')->logout();
        return response()->json(['message' => 'Logout successfully'], 200);
    }
}
