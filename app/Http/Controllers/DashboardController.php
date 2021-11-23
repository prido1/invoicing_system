<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $invoices = Invoice::all();
        $quotations = Quotation::all();
        $users = User::all();
        $clients = Client::all();
        $due = Carbon::createFromDate('2021', '09', '13');
        $left = Carbon::now()->diffInDays($due);
        
        return view('dashboard')->with([
            'invoices' => $invoices,
            'quotations' => $quotations,
            'users' => $users,
            'clients' => $clients,
            'left' => $left
        ]);
    }
}
