<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    //list clients
    public function index()
    {
        if (!Gate::allows('list', 'client')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $clients = Client::paginate(15);
        return view('modules.client.list-client')->with(['clients'=>$clients]);
    }

    //view client
    public function viewClient()
    {

    }

    //search client
    public function getBySearch(Request $request){
        if (!Gate::allows('list', 'client')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate(['term'=>'required']);

        $clients = Client::where('name', 'like', '%'.$request->term.'%')
            ->orWhere('email', $request->term)
            ->orWhere('company_name', 'like', '%'.$request->term.'%')
            ->paginate(15);
        return view('modules.client.list-client')->with(['clients'=>$clients]);
    }

    //create client
    public function createClient()
    {
        if (!Gate::allows('create', 'client')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        return view('modules.client.create-client');
    }

    //save client
    public function saveClient(Request $request)
    {
        if (!Gate::allows('create', 'client')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate([
            'company_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        Client::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->back()->with(['success' => 'client created successfully']);
    }

    //edit client
    public function editClient($id)
    {
        if (!Gate::allows('update', 'client')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $client = Client::find($id);
        return view('modules.client.edit-client')->with(['client' => $client]);
    }

    //update client
    public function updateClient(Request $request, $id)
    {
        if (!Gate::allows('update', 'client')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate([
            'company_name' => 'required',
            'email' => 'required',
        ]);

        $client = Client::find($id);

        $client->name = $request->name;
        $client->company_name = $request->company_name;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->update();

        return redirect()->back()->with(['success' => 'client created successfully']);
    }

    //destroy
    public function destroy($id)
    {
        (Client::find($id))->delete();
        echo 'done';
    }

}
