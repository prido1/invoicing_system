<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (!Gate::allows('list', 'role')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $roles = Role::all();
        return view('modules.roles.list')->with(['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        if (!Gate::allows('create', 'role')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        return view('modules.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create', 'role')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate([
            'name' => 'required|max:20'
        ]);
        Role::create([
            'name' => $request->name
        ]);
        return redirect()->route('admin.role.index');
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
    public function edit(Role $role)
    {
        if (!Gate::allows('update', 'role')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        return view('modules.roles.edit')->with(['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if (!Gate::allows('update', 'role')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate([
            'name' => 'required|max:20'
        ]);
        $role->update([
            'name' => $request->name
        ]);
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Role $role)
    {
        if (!Gate::allows('delete', 'role')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $role->delete();
        return redirect()->route('admin.role.index');
    }
}
