<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 🧾 Register a new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        DB::table('users')->insert([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'company_id' => $request->company_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'User registered successfully!'], 201);
    }

    // 🔐 Login
    public function login(Request $request)
    {
        $user = DB::table('users')->where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Optionally return company info too
        $company = DB::table('companies')->where('id', $user->company_id)->first();

        return response()->json([
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'company' => $company->name ?? null,
            ]
        ]);
    }

    // 🏢 Fetch company list (for dropdown)
    public function companies()
{
    return DB::table('companies')->take(2)->get();
}

}
