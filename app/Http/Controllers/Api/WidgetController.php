<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function widgetCount()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'message' => 'User not authenticated',
                'status' => 401
            ], 401);
        }

        // Contamos las contraseñas asociadas al usuario
        $passwordCount = Password::where('user_id', $userId)->count();

        return response()->json([
            'message' => 'Password count retrieved successfully',
            'data' => [
                'count' => $passwordCount
            ],
            'status' => 200
        ], 200);
    }
}
