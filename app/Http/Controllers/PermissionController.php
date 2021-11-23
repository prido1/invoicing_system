<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (!Gate::allows('list', 'permission')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $permissions = Permission::all();
        return view('modules.permissions.list')->with(['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        if (!Gate::allows('create', 'permission')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        return view('modules.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create', 'permission')){
            return response()->json(['message'=>'not authorized'], 403);
        }

        $request->validate([
            'role_id' => 'required|unique:permissions',
            'permission' => 'required'
        ]);
        Permission::create([
            'role_id' => $request->role_id,
            'permission' => $request->permission
        ]);
        return redirect()->route('admin.permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Permission $permission)
    {
        if (!Gate::allows('update', 'permission')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        return view('modules.permissions.edit')->with(['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        if (!Gate::allows('update', 'permission')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate([
            'role_id' => 'required|unique:permissions,role_id,'.$permission->id,
            'permission' => 'required'
        ]);
        $permission->update([
            'role_id' => $request->role_id,
            'permission' => $request->permission
        ]);
        return redirect()->route('admin.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Permission $permission)
    {
        if (!Gate::allows('delete', 'permission')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $permission->delete();
        return redirect()->route('admin.permission.index');
    }
}
