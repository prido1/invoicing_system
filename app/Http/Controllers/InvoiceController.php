<?php

namespace App\Http\Controllers;

use App\Helpers\SendEmailHelper;
use App\Models\Client;
use App\Models\EmailTemplate;
use App\Models\Invoice;
use App\Models\InvoiceEmail;
use App\Models\InvoiceItem;
use App\Models\PaymentCurrency;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use App\Models\Settings;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{
    //list invoice
    public function index()
    {
        if (!Gate::allows('list', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $invoices = Invoice::latest()->has('client')->paginate(15);
        return view('modules.invoice.list-invoice')->with(['invoices' => $invoices]);
    }

    //search invoice
    public function getBySearchTearm(Request $request)
    {
        if (!Gate::allows('list', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $request->validate([
            'search_term' => 'required',
        ]);

        $invoices = Invoice::with('client')
            ->whereHas('client', function (Builder $query) use ($request) {
                $query->where('email', $request->search_term)
                    ->orWhere('company_name', 'like', '%' . $request->search_term . '%')
                    ->orWhere('name', 'like', '%' . $request->search_term . '%');
            })->paginate(15);
        return view('modules.invoice.list-invoice')->with(['invoices' => $invoices]);
    }

    //view invoice
    public function viewInvoice($id)
    {
        if (!Gate::allows('read', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
        //to be removed
        $due = Carbon::createFromDate('2021', '09', '13');
        $left = Carbon::now()->diffInDays($due);

        $invoice = Invoice::find($id);
        $templates = EmailTemplate::all();
        $total = 0;
        foreach ($invoice->items as $item) {
            $total = $total + ($item->quantity * $item->unit_price);
        }
        return view('modules.invoice.view-invoice')->with(['left' => $left, 'templates' => $templates, 'invoice' => $invoice, 'total_price' => $total, 'settings' => $settings]);
    }

    //create invoice
    public function create()
    {
        if (!Gate::allows('create', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $clients = Client::all();
        $payment_type = PaymentType::all();
        $payment_status = PaymentStatus::all();
        $payment_currency = PaymentCurrency::all();
        return view('modules.invoice.create-invoice')->with([
            'clients' => $clients,
            'payment_type' => $payment_type,
            'payment_status' => $payment_status,
            'payment_currency' => $payment_currency,
        ]);
    }

    //copy invoice
    public function copy($id)
    {
        if (!Gate::allows('create', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $invoice = Invoice::find($id);
        $clients = Client::all();
        $payment_type = PaymentType::all();
        $payment_status = PaymentStatus::all();
        $payment_currency = PaymentCurrency::all();

        $total = 0;
        foreach ($invoice->items as $item) {
            $total = $total + ($item->quantity * $item->unit_price);
        }
        return view('modules.invoice.create-invoice')->with([
            'clients' => $clients,
            'payment_type' => $payment_type,
            'payment_status' => $payment_status,
            'payment_currency' => $payment_currency,
            'invoice' => $invoice,
            'total_price' => $total,
        ]);
    }

    //save invoice
    public function saveInvoice(Request $request)
    {
        if (!Gate::allows('create', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }

        $request->validate([
            'client_id' => 'required',
            'create_date' => 'required',
            'due_date' => 'required',
            'payment_type' => 'required',
            'payment_status' => 'required',
            'payment_currency' => 'required',
            'quantity.*' => 'required',
            'unit_price.*' => 'required',
            'description.*' => 'required',
        ], ['description.*.required'=>'Description required',
            'unit_price.*.required'=>'Unit price required',
            'quantity.*.required'=>'Quantity required']);

        $invoice = Invoice::create([
            'client_id' => $request->client_id,
            'user_id' => Auth::id(),
            'create_date' => $request->create_date,
            'due_date' => $request->due_date,
            'note' => $request->note,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_status,
            'payment_currency' => $request->payment_currency,
            'discount' => $request->discount ?? 0,
            'terms_condition' => $request->terms_conditions,
            'vat' => $request->vat ?? 0
        ]);

        foreach ($request->quantity as $key => $value) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key],
                'unit_price' => $request->unit_price[$key],
            ]);
        }

        return response()->json(['redirect'=>route('invoice.view', ['id'=>$invoice->id])]);

    }

    //edit invoice
    public function edit($id)
    {
        if (!Gate::allows('update', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $invoice = Invoice::find($id);
        $clients = Client::all();
        $payment_type = PaymentType::all();
        $payment_status = PaymentStatus::all();
        $payment_currency = PaymentCurrency::all();
        $total = 0;
        foreach ($invoice->items as $item) {
            $total = $total + ($item->quantity * $item->unit_price);
        }
        return view('modules.invoice.edit-invoice')->with([
            'clients' => $clients,
            'payment_type' => $payment_type,
            'payment_status' => $payment_status,
            'payment_currency' => $payment_currency,
            'invoice' => $invoice,
            'total_price' => $total,
        ]);
    }

    //update invoice
    public function update(Request $request, $id)
    {
        if (!Gate::allows('update', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }

        $request->validate([
            'client_id' => 'required',
            'create_date' => 'required',
            'due_date' => 'required',
            'payment_type' => 'required',
            'payment_status' => 'required',
            'payment_currency' => 'required',
            'quantity.*' => 'required',
            'unit_price.*' => 'required',
            'description.*' => 'required',
        ], ['description.*.required'=>'Description required',
            'unit_price.*.required'=>'Unit price required',
            'quantity.*.required'=>'Quantity required']);

        $invoice = Invoice::find($id);
        $invoice->client_id = $request->client_id;
        $invoice->user_id = Auth::id();
        $invoice->create_date = $request->create_date;
        $invoice->due_date = $request->due_date;
        $invoice->note = $request->note;
        $invoice->payment_type = $request->payment_type;
        $invoice->payment_status = $request->payment_status;
        $invoice->payment_currency = $request->payment_currency;
        $invoice->discount = $request->discount ?? 0;
        $invoice->terms_condition = $request->terms_conditions;
        $invoice->vat = $request->vat ?? 0;
        $invoice->update();

        $items = InvoiceItem::where('invoice_id', $invoice->id);
        $items->delete();

        foreach ($request->quantity as $key => $value) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key],
                'unit_price' => $request->unit_price[$key],
            ]);
        }

        return response()->json(['redirect'=>route('invoice.view', ['id'=>$invoice->id])]);
    }

    //destroy
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice) {
            $invoice->delete();
            return redirect()->back()->with(['success' => 'invoice deleted successfully']);
        }
        return redirect()->back()->with(['error' => 'invoice not found']);
    }

    //send invoice
    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
        ]);
        $invoice = Invoice::find($request->invoice_id);
        if (!$invoice) {
            return redirect()->back()->with(['error' => 'Invoice not found']);
        }

        if ($request->has('schedule')) {
            $invoice->email_subject = $request->subject;
            $invoice->email_body = $request->body;
            $invoice->schedule_date = Carbon::parse($request->schedule_date);
            $invoice->is_scheduled = true;
            $invoice->attach = $request->has('attach');

            $invoice->update();
            return redirect()->back()->with(['success' => 'Email is scheduled successfully']);
        } else {
            $invoice->is_scheduled = false;
            $invoice->is_schedule_sent = false;
            $invoice->update();
        }
        $attachment = null;
        $title = "<h2>$request->subject</h2>";
        $content = "<p>$request->body</p>";
        if ($request->has('attach')) {
            $attachment = $this->storeInvoice($invoice);
        }

        try {
            SendEmailHelper::sendEmail($invoice->client->email, $request->subject, $title, $content, $attachment);

        } catch (\Exception$e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        $this->createEmailHistory($invoice->client_id, true, now());
        return redirect()->back()->with(['success' => 'invoice sent successfully']);
    }

    private function createEmailHistory($client_id, $status, $time)
    {
        InvoiceEmail::create([
            'client_id' => $client_id,
            'sent' => $status,
            'sent_at' => $time,
        ]);
        return true;
    }

    private function storeInvoice($invoice)
    {
        $total_price = 0;
        foreach ($invoice->items as $item) {
            $total_price = $total_price + ($item->quantity * $item->unit_price);
        }
        $total_price = $total_price * ($invoice->vat / 100 + 1);
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
        try {
            $file_name = date('Y-m-d-H-i-s') . "-invoice-" . $invoice->id . '.pdf';
            $pdf = PDF::loadView('modules.invoice.pdf', compact('invoice', 'total_price', 'settings'));
            $invoicePath = 'assets/pdf' . '/' . $file_name;
            $pdf->save($invoicePath);

        } catch (\Exception$e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        return (object) ['filename' => $file_name, 'path' => $invoicePath];
    }

    public function printInvoice($id)
    {
        $invoice = Invoice::find($id);
        $total_price = 0;
        foreach ($invoice->items as $item) {
            $total_price = $total_price + ($item->quantity * $item->unit_price);
        }
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
        // dd($settings);
        $total_price = $total_price * ($invoice->vat / 100 + 1);
 $file_name = date('Y-m-d-H-i-s') . "-invoice-" . $invoice->id . '.pdf';
            $pdf = PDF::loadView('modules.invoice.pdf', compact('invoice', 'total_price', 'settings'));
            $invoicePath = 'assets/pdf' . '/' . $file_name;
        if ($pdf->save($invoicePath)) {
            return $pdf->stream();
        } else {
            return false;
        }
    }

    public function sendFromCron($invoice, $cause = null)
    {

        $attachment = null;
        $title = "<h2>" . $invoice->subject . "</h2>";
        $content = "<p>" . $invoice->body . "</p>";
        if ($invoice->attach === true) {
            $attachment = $this->storeInvoice($invoice);
        }

        try {
            SendEmailHelper::sendEmail($invoice->client->email, $invoice->subject, $title, $content, $attachment);

        } catch (\Exception$e) {
            return false;
        }

        if ($cause == 'schedule') {
            $invoice->is_schedule_sent = true;
            $invoice->update();
        }

        // $this->createEmailHistory($invoice->client_id, true, Carbon::now());
        return true;
    }

    public function listSent()
    {

    }
}
