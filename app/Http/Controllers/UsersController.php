<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Get all users.
     */
    public function getAllUsers(Request $request)
    {
        $users = Users::all();
        return response()->json([
            'message' => 'Get all users',
            'data' => $users
        ]);
    }
    
    /**
     * Register a new user.
     */
    public function register(Request $request){

        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'email_verified_at' => 'date',
                'password' => 'required|string|min:8',
                'phone' => 'required|string|min:8',
                'remember_token' => 'string'
            ]);

            $user = Users::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'remember_token' => Str::random(10)
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'data' => $user
            ], 201);

        }catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage()
            ], 400);

        }
    }

    /**
     * Login a user.
     */
    public function login(Request $request){
        try{
            $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8'
            ]);

            $credentials = $request->only('email', 'password');

            if(!Auth::attempt($credentials)){
                throw new Exception('Invalid credentials');
            }

            $user = $request->user();

            $token = $user->createToken('auth_token')->plainTextToken;            

            return response()->json([
                'message' => 'User logged successfully',
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ], 200);

        }catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }

    /**
     * Logout a user.
     */
    public function logout(Request $request){
        try{
            $request->user()->tokens()->delete();

            return response()->json([
                'message' => 'User logged out successfully'
            ], 200);

        }catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }

    /**
     * Get all users by letter R.
     */
    public function getUsersByLetter(){
        $users = Users::where('name', 'like', 'R%')->get();
        return response()->json([
            'message' => 'Get all users by letter R',
            'data' => $users
        ]);
    }

}
