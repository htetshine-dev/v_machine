<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Traits\RelativePathTrait;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Validator;

class AuthApiController extends Controller
{
    use RelativePathTrait;

    public function __construct()
    {
        $this->setRelativePaths();
    }

    // Register API
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = DB::transaction(function() use($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $role = Role::findByName($this->relativeRole);
            $user->assignRole($role);
            return $user;
        });

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    // Login API
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        // dd($user, $user->getRoleNames());

        if (!$user || $user->getRoleNames()->first() != 'client') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
        ]);
    }

    // Get Authenticated User Info
    public function me()
    {
        return response()->json(auth()->user());
    }

    // Logout API
    public function logout()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'No user is currently logged in'], 401);
        }
        
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}

