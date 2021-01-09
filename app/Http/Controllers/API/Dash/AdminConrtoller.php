<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\AdminRequest;
use App\Http\Resources\Dash\AdminResource;
use App\Models\User;

class AdminConrtoller extends Controller
{
    public function index()
    {
        $admins = User::where('role', 1)->orderBy('id', 'desc')->get(['name', 'email', 'role']);
        return AdminResource::collection($admins);
    }

    public function store(AdminRequest $request)
    {
        // Cek max admin
        if (User::where('role', 1)->count() >= 4)  {
            return response()->json([ "message" => "The item max 4"], 401);
        }
        $data = $request->validated();
        $data['role'] = 1;
        $data['password'] = \Hash::make($request->password);
        User::create($data);
        return response()->json([ "message" => "The item was created successfully"], 201);
    }

    public function show(User $user)
    {
        return AdminResource::make($user);
    }

    public function update(AdminRequest $request, User $user)
    {
        $data = $request->validated();
        $data['password'] = \Hash::make($request->password);
        $user->update($data);
        return AdminResource::make($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([ "message" => "The item was delete successfully"], 204);
    }
}
