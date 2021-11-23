<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('modules.profile.profile')->with(['user' => $user]);
    }

    public function update(Request $request){
        $user = Auth::user();

        $request->validate([
            'email' => 'email|required|unique:users,email,' . $user->id,
            'name' => 'required',
            'password' => 'nullable',
            'role_id' => 'nullable',
        ]);

        $data['email'] = strtolower($request->email);
        $data['phone'] = $request->phone;
        $data['name'] = $request->name;
        $data['password'] = $request->password === null ? $user->password : bcrypt($request->password);
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . $file->getClientOriginalName();
            $file->move('assets/signatures/', str_replace(' ', '', $file_name));
            $data['signature_path'] = 'assets/signatures/' . str_replace(' ', '', $file_name);
        }
        $user->update($data);

        return redirect()->back()->with(['success'=>'profile updated']);
    }
}
