<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
        return view('login')->with(['settings' => $settings]);
    }

    public function signIn(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        $loginData = array_merge($loginData);
        if (!auth()->attempt($loginData)) {
            return redirect()->back()->with(['error'=> 'invalid credentials']);
        }
        return redirect()->intended('dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

    public function store(Request $request)
    {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role_id' => 'required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'is_admin' => true,
                'role_id' => $request->role_id,
                'password' => bcrypt($request->password)
            ]);

            return redirect('users?staff')->with(['success' => 'user created successfully']);

    }
}
