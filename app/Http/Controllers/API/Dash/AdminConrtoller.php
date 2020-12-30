<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\AdminResource;
use App\Models\User;
use Illuminate\Http\Request;

class AdminConrtoller extends Controller
{
    public function index()
    {
        $admins = User::where('role', 1)->orderBy('id', 'desc')->get(['name', 'email', 'role']);
        return AdminResource::collection($admins);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|min:3|max:20',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $data['role'] = 1;
        $data['password'] = \Hash::make($request->password);
        User::create($data);
        return response()->json([ "message" => "The item was created successfully"], 201);
    }
}
