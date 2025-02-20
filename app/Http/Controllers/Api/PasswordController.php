<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'message' => 'User not authenticated',
                'status' => 401
            ], 401);
        }

        $passwords = Password::where('user_id', $userId)->get();

        if ($passwords->isEmpty()) {
            return response()->json([
                'message' => 'No passwords found for the authenticated user',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Passwords retrieved successfully',
            'data' => $passwords,
            'status' => 200
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'message' => 'User not authenticated',
                'status' => 401
            ], 401);
        }

        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:passwords',
            'email' => 'required|email|max:100|unique:passwords',
            'URL' => 'required|string|max:100',
            'password_encrypted' => 'required|string|min:8',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Error in data validation',
                'errors' => $validation->errors(),
                'status' => 400
            ], 400);
        }

        $passwordData = $request->only(['name', 'username', 'email', 'URL']);
        $passwordData['password_encrypted'] = Hash::make($request->password_encrypted);
        $passwordData['user_id'] = $userId;

        $password = Password::create($passwordData);

        return response()->json([
            'message' => 'Password created successfully',
            'data' => $password,
            'status' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'message' => 'User not authenticated',
                'status' => 401
            ], 401);
        }

        $password = Password::where('id', $id)->where('user_id', $userId)->first();

        if (!$password) {
            return response()->json([
                'message' => 'Password not found or not authorized',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Password found',
            'data' => $password,
            'status' => 200
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'message' => 'User not authenticated',
                'status' => 401
            ], 401);
        }

        $password = Password::where('id', $id)->where('user_id', $userId)->first();

        if (!$password) {
            return response()->json([
                'message' => 'Password not found or not authorized',
                'status' => 404
            ], 404);
        }

        $validation = Validator::make($request->all(), [
            'name' => 'string|max:100',
            'username' => 'string|max:100|unique:passwords',
            'email' => 'email|max:100|unique:passwords',
            'URL' => 'string|max:100',
            'password_encrypted' => 'string|min:8',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Error in data validation',
                'errors' => $validation->errors(),
                'status' => 400
            ], 400);
        }

        $updateData = $request->only(['name', 'username', 'email', 'URL']);

        if ($request->has('password_encrypted')) {
            $updateData['password_encrypted'] = Hash::make($request->password_encrypted);
        }

        $password->update($updateData);

        return response()->json([
            'message' => 'Password updated successfully',
            'data' => $password,
            'status' => 200
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'message' => 'User not authenticated',
                'status' => 401
            ], 401);
        }

        $password = Password::where('id', $id)->where('user_id', $userId)->first();

        if (!$password) {
            return response()->json([
                'message' => 'Password not found or not authorized',
                'status' => 404
            ], 404);
        }

        $password->delete();

        return response()->json([
            'message' => 'Password deleted successfully',
            'status' => 200
        ], 200);
    }
}
