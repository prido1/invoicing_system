<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\EmailTemplate;
use App\Models\Invoice;
use App\Models\InvoiceEmail;
use App\Models\InvoiceItem;
use App\Models\PaymentCurrency;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    //list invoice
    public function index()
    {
        if (!Gate::allows('list', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $invoices = Invoice::paginate(15);
        return view('modules.invoice.list-invoice')->with(['invoices' => $invoices]);
    }

    //search invoice
    public function getBySearchTearm(Request $request)
    {
        if (!Gate::allows('list', 'invoice')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $request->validate([
            'search_term' => 'required'
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
        //to be removed
        $due = Carbon::createFromDate('2021', '09', '13');
        $left = Carbon::now()->diffInDays($due);


        $invoice = Invoice::find($id);
        $templates = EmailTemplate::all();
        $total = 0;
        foreach ($invoice->items as $item) {
            $total = $total + ($item->quantity * $item->unit_price);
        }
        return view('modules.invoice.view-invoice')->with(['left'=>$left, 'templates' => $templates, 'invoice' => $invoice, 'total_price' => $total]);
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
            'total_price' => $total
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
        ]);

        $invoice = Invoice::create([
            'client_id' => $request->client_id,
            'user_id' => Auth::id(),
            'create_date' => $request->create_date,
            'due_date' => $request->due_date,
            'note' => $request->note,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_status,
            'payment_currency' => $request->payment_currency,
            'discount' => $request->discount,
            'terms_condition' => $request->terms_conditions
        ]);

        foreach ($request->quantity as $key => $value) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key],
                'unit_price' => $request->unit_price[$key]
            ]);
        }

        return redirect('admin/invoice/view/' . $invoice->id);

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
            'total_price' => $total
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
        ]);

        $invoice = Invoice::find($id);
        $invoice->client_id = $request->client_id;
        $invoice->user_id = Auth::id();
        $invoice->create_date = $request->create_date;
        $invoice->due_date = $request->due_date;
        $invoice->note = $request->note;
        $invoice->payment_type = $request->payment_type;
        $invoice->payment_status = $request->payment_status;
        $invoice->payment_currency = $request->payment_currency;
        $invoice->discount = $request->discount;
        $invoice->terms_condition = $request->terms_conditions;
        $invoice->update();

        $items = InvoiceItem::where('invoice_id', $invoice->id);
        $items->delete();

        foreach ($request->quantity as $key => $value) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key],
                'unit_price' => $request->unit_price[$key]
            ]);
        }

        return redirect('admin/invoice/view/' . $invoice->id);
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
        if (!$invoice) return redirect()->back()->with(['error' => 'Invoice not found']);

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
        $attachedFileName = '';
        $title = "<h2>$request->subject</h2>";
        $content = "<p>$request->body</p>";
        if ($request->has('attach')) {
            $attachedFileName = $this->storeInvoice($invoice);
        }

        try {
            Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) use ($request, $attachedFileName, $invoice) {
               $email = str_replace(' ', '', $invoice->client->email);
                $receipients = explode(',', $email);
                $message->to($receipients);
                $message->subject($request->subject);
                if ($attachedFileName != "") {
                    $message->attach($attachedFileName, ['mime' => 'pdf']);
                }
            });
        } catch (\Exception $e) {
            $this->createEmailHistory($invoice->client_id, false, now());
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
            'sent_at' => $time
        ]);
        return true;
    }

    private function storeInvoice($invoice)
    {
        $total_price = 0;
        foreach ($invoice->items as $item) {
            $total_price = $total_price + ($item->quantity * $item->unit_price);
        }
        try {
            $pdf = PDF::loadView('modules.invoice.pdf', compact('invoice', 'total_price'));
            $invoicePath = 'assets/pdf' . '/' . date('Y-m-d-H-i-s') . "-invoice-" . $invoice->id . '.pdf';
            $pdf->save($invoicePath);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        return $invoicePath;
    }

    public function printInvoice($id)
    {
        $invoice = Invoice::find($id);
        $total_price = 0;
        foreach ($invoice->items as $item) {
            $total_price = $total_price + ($item->quantity * $item->unit_price);
        }
        $pdf = PDF::loadView('modules.invoice.pdf', compact('invoice', 'total_price'));
        $invoicePath = 'assets/pdf' . '/-invoice-' . $invoice->id . '.pdf';
        if ($pdf->save($invoicePath)) {
            return $pdf->stream();
        } else {
            return false;
        }
    }

    public function sendFromCron($invoice, $cause = null)
    {

        $attachedFileName = '';
        $title = "<h2>$invoice->subject</h2>";
        $content = "<p>$invoice->body</p>";
        if ($invoice->attach === true) {
            $attachedFileName = $this->storeInvoice($invoice);
        }

        try {
            Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) use ($attachedFileName, $invoice) {
                $email = str_replace(' ', '', $invoice->client->email);
                $receipients = explode(',', $email);
                $message->to($receipients);
                $message->subject($invoice->subject);
                if ($attachedFileName != "") {
                    $message->attach($attachedFileName, ['mime' => 'pdf']);
                }
            });
        } catch (\Exception $e) {
            $this->createEmailHistory($invoice->client_id, false, Carbon::now());
            return false;
        }
        if ($cause == 'schedule') {
            $invoice->is_schedule_sent = true;
            $invoice->update();
        }

        $this->createEmailHistory($invoice->client_id, true, Carbon::now());
        return true;
    }
}
