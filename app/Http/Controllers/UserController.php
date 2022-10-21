<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(){
        if (!Gate::allows('list', 'user')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $users = User::paginate(15);
        return view('modules.users.list-users')->with(['users' => $users]);
    }

    public function destroy(Request $request){
        if (!Gate::allows('delete', 'user')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $user = User::find($request->user_id);
        $user->delete();
        $data['status'] = "success";
        $data['message'] = __('successfully_deleted');
        echo json_encode($data);
    }

    public function edit($id)
    {
        if (!Gate::allows('update', 'user')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $user = User::find($id);
            return view('modules.users.edit-user')->with(['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('update', 'user')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $user = User::find($id);

            $request->validate([
                'email' => 'email|required|unique:users,email,' . $id,
                'name' => 'required',
                'password' => 'nullable',
                'role_id' => 'nullable',
            ]);

            $data['email'] = strtolower($request->email);
            $data['name'] = $request->name;
            $data['password'] = $request->password === null ? $user->password : bcrypt($request->password);
            $data['role_id'] = $request->role_id === null ? $user->role_id : $request->role_id;

            $user->update($data);

            return redirect('user/edit/' . $id . '?staff')->with(['success' => 'updated successfully']);

    }

    public function status(Request $request){
        $user = $request->user_id;
        $status = $request->action;

        $user = User::find($user);
        $user['status'] = $status;
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'user status changed'], 200);

    }

    public function create(){
        if (!Gate::allows('create', 'user')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        return view('modules.users.create-user');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('create', 'user')){
            return response()->json(['message'=>'not authorized'], 403);
        }
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role_id' => 'required'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'is_admin' => true,
                'role_id' => $request->role_id,
                'password' => bcrypt($request->password)
            ]);

            return redirect('user')->with(['success' => 'user created successfully']);
    }
}
