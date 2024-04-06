<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\AuthenticationResource;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        if(!$validatedData){
            return response()->json([
                'message' => $request->errors()->first()
            ],422);
        } else{
            $user = User::create([
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password'])
            ]);
            $token = $user->createToken('token')->accessToken;
            $hash = sha1($user->getEmailForVerification());
            event(new Registered($user));
            return response()->json([
                'users' => new AuthenticationResource($user),
                'token' => $token,
                'id' => $user->id,
                'hash' => $hash
            ], 200);
        }
    }
    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::where('email', $validatedData['email'])->first();
            if(!$user || !Hash::check($validatedData['password'], $user->password)){
                return response()->json([
                    'message' => 'The selected password is in valid',
                ],422);
            }
            $token = $user->createToken('token')->accessToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
    }
    public function logout()
    {
        $users = auth()->user()->token()->revoke();
        return response()->json([
            'status' => 200,
            'message' => 'Successfully signout'
        ], 200);
    }
    public function reset(ResetRequest $request, $id)
    {
        $validatedData = $request->validated();
        $users = User::find($id);
        if($user){
            $users->update([
                'password' => Hash::make($validatedData['password'])
            ]);
            $token = $users->createToken('token')->accessToken;
            return response()->json([
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'message' => $request->errors()->first(),
            ], 422);
        }
    }
}
