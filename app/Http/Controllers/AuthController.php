<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'user' => $user->makeHidden(['password', 'remember_token']),
            'token' => $this->generateToken($user)
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        return response()->json([
            'message' => 'Login correcto',
            'user' => $user,
            'token' => $this->generateToken($user)
        ]);
    }
    public function logout()
    {
        $user = auth()->user();

        if ($user && method_exists($user, 'currentAccessToken')) {
            $user->currentAccessToken()->delete();
        }

        return response()->json([
            'message' => 'Logout correcto'
        ]);
    }

    private function generateToken(User $user): string
    {
        $user->tokens()->delete();

        return $user->createToken('api-token')->plainTextToken;
    }
}
