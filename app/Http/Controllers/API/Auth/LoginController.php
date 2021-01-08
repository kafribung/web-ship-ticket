<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        // Cara 1
        $data = $request->validated();
        if (Auth::attempt($data)) {
            //cek middleware manual
            if (auth()->user()->role == 0) { 
                return response()->json(['message' => 'Your not super admin'], 401);
            }
            $data = Auth::user();
            $data['token'] = $request->user()->createToken($request->email)->plainTextToken;
            return LoginResource::make($data);
        } else 
        return response()->json(['message' => 'The provided credentials do not match our records.' ], 400);

        // $user = User::where('email', $request->email)->first();
        // if (! $user || ! Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'email' => ['The provided credentials are incorrect.'],
        //     ]);
        // }
        // // Delete token yang ada di db personal_acces_token
        // // $request->user()->tokens()->delete();
        // $data = $user;
        // $data['token'] = $user->createToken($request->email)->plainTextToken;
        // return LoginResource::make($data);
    }
}
