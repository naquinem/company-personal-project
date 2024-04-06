<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    public function notice()
    {
        return response()->json([
            'message' => 'Please check your email to verify your account',
        ],200);
    }
    public function verify(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return redirect()->away('http://localhost:8081/home');
        } else {
            return response()->json([
                'error' => 'Failed to verify email address'
            ], 500);
        }
    }
}
