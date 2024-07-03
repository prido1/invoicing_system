<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Settings;
use App\Models\Quotation;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\PaymentStatus;
use App\Models\QuotationItem;
use App\Models\PaymentCurrency;
use App\Helpers\SendEmailHelper;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;

class QuotationController extends Controller
{
    //list QuotationController
    public function index()
    {
        if (!Gate::allows('list', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $quotations = Quotation::paginate(15);
        return view('modules.quotation.list-quotation')->with(['quotations' => $quotations]);
    }

    //search QuotationController
    public function getBySearchTearm(Request $request)
    {
        if (!Gate::allows('list', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $request->validate([
            'search_term' => 'required'
        ]);

        $quotations = Quotation::with('client')
            ->whereHas('client', function (Builder $query) use ($request) {
                $query->where('email', $request->search_term)
                    ->orWhere('company_name', 'like', '%' . $request->search_term . '%')
                    ->orWhere('name', 'like', '%' . $request->search_term . '%');
            })->paginate(15);
        return view('modules.quotation.list-quotation')->with(['quotations' => $quotations]);
    }

    //view QuotationController
    public function viewQuotation($id)
    {
        if (!Gate::allows('read', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
        $quotation = Quotation::find($id);
        $templates = EmailTemplate::all();
        $total = 0;
        foreach ($quotation->items as $item) {
            $total = $total + ($item->quantity * $item->unit_price);
        }
        return view('modules.quotation.view-quotation')->with(['templates' => $templates, 'quotation' => $quotation, 'total_price' => $total, 'settings' => $settings]);

    }

    //create QuotationController
    public function create()
    {
        if (!Gate::allows('create', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $clients = Client::all();
        $payment_type = PaymentType::all();
        $payment_status = PaymentStatus::all();
        $payment_currency = PaymentCurrency::all();
        return view('modules.quotation.create-quotation')->with([
            'clients' => $clients,
            'payment_type' => $payment_type,
            'payment_status' => $payment_status,
            'payment_currency' => $payment_currency,
        ]);
    }

    //copy quotation
    public function copy($id)
    {
        if (!Gate::allows('create', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $quotation = Quotation::find($id);
        $clients = Client::all();
        $payment_type = PaymentType::all();
        $payment_status = PaymentStatus::all();
        $payment_currency = PaymentCurrency::all();

        $total = 0;
        foreach ($quotation->items as $item) {
            $total = $total + ($item->quantity * $item->unit_price);
        }
        return view('modules.quotation.create-quotation')->with([
            'clients' => $clients,
            'payment_type' => $payment_type,
            'payment_status' => $payment_status,
            'payment_currency' => $payment_currency,
            'quotation' => $quotation,
            'total_price' => $total
        ]);
    }

    //save QuotationController
    public function saveQuotation(Request $request)
    {
        if (!Gate::allows('create', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }

        $request->validate([
            'client_id' => 'required',
            'create_date' => 'required',
            'due_date' => 'required',
            'payment_type' => 'required',
            'payment_currency' => 'required',
            'quantity.*' => 'required',
            'unit_price.*' => 'required',
            'description.*' => 'required',
        ], ['description.*.required'=>'Description required',
            'unit_price.*.required'=>'Unit price required',
            'quantity.*.required'=>'Quantity required']);

        $quotation = Quotation::create([
            'client_id' => $request->client_id,
            'user_id' => Auth::id(),
            'create_date' => $request->create_date,
            'note' => $request->note,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_status,
            'payment_currency' => $request->payment_currency,
            'discount' => $request->discount,
            'terms_condition' => $request->terms_conditions,
            'vat' => $request->vat
        ]);

        foreach ($request->quantity as $key => $value) {
            QuotationItem::create([
                'quotation_id' => $quotation->id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key],
                'unit_price' => $request->unit_price[$key]
            ]);
        }

        return response()->json(['redirect'=>route('quotation.view', ['id'=>$quotation->id])]);
    }

    //edit QuotationController
    public function edit($id)
    {
        if (!Gate::allows('update', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $quotation = Quotation::find($id);
        $clients = Client::all();
        $payment_type = PaymentType::all();
        $payment_status = PaymentStatus::all();
        $payment_currency = PaymentCurrency::all();
        $total = 0;
        foreach ($quotation->items as $item) {
            $total = $total + ($item->quantity * $item->unit_price);
        }

        return view('modules.quotation.edit-quotation')->with([
            'clients' => $clients,
            'payment_type' => $payment_type,
            'payment_status' => $payment_status,
            'payment_currency' => $payment_currency,
            'quotation' => $quotation,
            'total_price' => $total
        ]);
    }

    //update QuotationController
    public function update(Request $request, $id)
    {
        if (!Gate::allows('update', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $request->validate([
            'client_id' => 'required',
            'create_date' => 'required',
            'due_date' => 'required',
            'payment_type' => 'required',
            'payment_currency' => 'required',
            'quantity.*' => 'required',
            'unit_price.*' => 'required',
            'description.*' => 'required',
        ], ['description.*.required'=>'Description required',
            'unit_price.*.required'=>'Unit price required',
            'quantity.*.required'=>'Quantity required']);

        $quotation = Quotation::find($id);
        $quotation->client_id = $request->client_id;
        $quotation->user_id = Auth::id();
        $quotation->create_date = $request->create_date;
        $quotation->note = $request->note;
        $quotation->payment_type = $request->payment_type;
        $quotation->payment_currency = $request->payment_currency;
        $quotation->discount = $request->discount;
        $quotation->terms_condition = $request->terms_conditions;
        $quotation->vat = $request->vat;
        $quotation->update();

        $items = QuotationItem::where('quotation_id', $quotation->id);
        $items->delete();

        foreach ($request->quantity as $key => $value) {
            QuotationItem::create([
                'quotation_id' => $quotation->id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key],
                'unit_price' => $request->unit_price[$key]
            ]);
        }

        return response()->json(['redirect'=>route('quotation.view', ['id'=>$quotation->id])]);
    }

    //destroy
    public function destroy($id)
    {
        if (!Gate::allows('delete', 'quotation')) {
            return response()->json(['message' => 'not authorized'], 403);
        }
        $quotation = Quotation::find($id);
        if ($quotation) {
            $quotation->delete();
            return redirect()->back()->with(['success' => 'quotation deleted successfully']);
        }
        return redirect()->back()->with(['error' => 'quotation not found']);
    }

    //send invoice
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);
        $attachment = null;
        $title = "<h2>$request->subject</h2>";
        $content = "<p>$request->body</p>";
        if ($request->has('attach')) {
            $attachment = $this->storeInvoice($request->quotation_id);
        }

        try {
            SendEmailHelper::sendEmail($request->email, $request->subject, $title, $content, $attachment);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        return redirect()->back()->with(['success' => 'quotation sent successfully']);
    }

    private function storeInvoice($id)
    {
        $quotation = Quotation::find($id);
        $total_price = 0;
        foreach ($quotation->items as $item) {
            $total_price = $total_price + ($item->quantity * $item->unit_price);
        }
        $total_price = $total_price * ($quotation->vat / 100 + 1);
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
        try {
            $file_name = date('Y-m-d-H-i-s') . '-quotation-' . $quotation->id . '.pdf';
            $pdf = PDF::loadView('modules.quotation.pdf', compact('quotation', 'total_price', 'settings'));
            $quotationPath = 'assets/pdf/'.$file_name;
            $pdf->save($quotationPath);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);

        }
        return (object) ['filename' => $file_name, 'path' => $quotationPath];
    }

    public function printQuotation($id)
    {
        $quotation = Quotation::find($id);
        $total_price = 0;
        foreach ($quotation->items as $item) {
            $total_price = $total_price + ($item->quantity * $item->unit_price);
        }
        $total_price = $total_price * ($quotation->vat / 100 + 1);
        $settings = Settings::where('type', 'system')->pluck('description', 'label');
           $file_name = date('Y-m-d-H-i-s') . '-quotation-' . $quotation->id . '.pdf';
            $pdf = PDF::loadView('modules.quotation.pdf', compact('quotation', 'total_price', 'settings'));
            $quotationPath = 'assets/pdf/'.$file_name;
        if ($pdf->save($quotationPath)) {
            return $pdf->stream();
        } else {
            return false;
        }
    }
}
