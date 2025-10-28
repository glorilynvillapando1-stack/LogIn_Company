<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username'   => 'required|unique:users,username',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:4',
            'company_id' => 'required|exists:companies,id',
        ]);

        $user = new User();
        $user->username   = $validatedData['username'];
        $user->email      = $validatedData['email'];
        $user->password   = Hash::make($validatedData['password']);
        $user->company_id = $validatedData['company_id'];
        $user->save();

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        // 1️⃣ Validate input
        $credentials = $request->validate([
            'username'   => 'required',
            'password'   => 'required',
            'company_id' => 'required',
        ]);

        // 2️⃣ Find user in that company
        $user = User::where('username', $credentials['username'])
            ->where('company_id', $credentials['company_id'])
            ->first();

        // 3️⃣ Check credentials
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['login_error' => 'Invalid credentials']);
        }

        // 4️⃣ Get company info
        $company = DB::table('companies')->where('id', $user->company_id)->first();

        // 5️⃣ Store in session (so we can access later)
        session([
  'user' => $user,
  'company' => $company,
]);


        // 6️⃣ Redirect to dashboard view
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->flush(); // clear all session data
        return redirect()->route('login')->with('message', 'Logged out successfully');
    }
    
}
