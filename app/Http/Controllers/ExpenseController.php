<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    public function index(){
        if (!Gate::allows('list', 'expense')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $expenses = Expense::paginate(15);
        return view('modules.expense.list-expense')->with(['expenses'=>$expenses]);
    }

    public function viewExpense($id){
        if (!Gate::allows('read', 'expense')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $expense = Expense::find($id);
        return view('modules.expense.view-expense')->with(['expense'=>$expense]);
    }

    public function create(){
        if (!Gate::allows('create', 'expense')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        return view('modules.expense.create-expense');
    }

    public function save(Request $request){
        if (!Gate::allows('create', 'expense')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate(['title'=>'required', 'amount'=>'required']);
       $expense = new Expense();
       $expense->user_id = Auth::id();
       $expense->title = $request->title;
       $expense->note = $request->note;
       $expense->amount = $request->amount;

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . $file->getClientOriginalName();
            $file->move('assets/files/expenses/', str_replace(' ', '', $file_name));
            $expense->attachment = '/assets/files/offers/' . str_replace(' ', '', $file_name);
        }

        $expense->save();
        return redirect('expense')->with(['success' => 'client created successfully']);
    }

    public function destroy(){

    }
}
