<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register User
     */
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email|email',
            'password' => 'required|string|confirmed',
            'role' => 'string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role' => $fields['role']
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $user->attachRole($request->role);

        $user->last_seen = now();
        $user->save();

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Login existing user
     */
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check if user was found in db
        if(!$user) {
            return response([
                'message' => 'User not found'
            ], 404, ['Accept' => 'application/json']);
        }

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401, ['Accept' => 'application/json']);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $user->last_seen = now();
        $user->save();

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Logout
     */
    public function logout(Request $request) {
        auth()->user()->last_seen = now();
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    /**
     * Refresh sanctum token
     */
    public function refresh(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['token' => $user->createToken('refreshToken')->plainTextToken]);
    }
}
