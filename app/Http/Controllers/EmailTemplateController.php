<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\Invoice;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EmailTemplateController extends Controller
{
    public function index(){
        if (!Gate::allows('list', 'email_template')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $templates = EmailTemplate::paginate(15);
        return view('modules.email-template.list-email-template')->with(['templates'=>$templates]);
    }

    public function getTemplateInvoice(Request $request){
        $template = EmailTemplate::find($request->template_id);
        $message = $template->body;
        $invoice = Invoice::find($request->invoice_id);
        $client = $invoice->client;
$subject = $template->subject;
        $subject = str_replace('{invoice_no}', 'INV'.$invoice->id, $subject);
        $subject = str_replace('{due_date}', $invoice->due_date->format('M d Y'), $subject);

        foreach (config('config.TAGS') as $key => $value){
            if ($value == '{user_name}'){
                $message = str_replace('{user_name}', Auth::user()->name, $message);
            }
            if ($value == '{name}'){
                $message = str_replace('{name}', $client->name, $message);
            }
            if ($value == '{email}'){
                $message = str_replace('{email}', $client->email, $message);
            }
            if ($value == '{company_name}'){
                $message = str_replace('{company_name}', $client->company_name, $message);
            }
            if ($value == '{phone}'){
                $message = str_replace('{phone}', $client->phone, $message);
            }
            if ($value == '{address}'){
                $message = str_replace('{address}', $client->address, $message);
            }
            if ($value == '{invoice_no}'){
                $message = str_replace('{invoice_no}', $invoice->id, $message);
            }
            if ($value == '{total_due}'){
                $message = str_replace('{total_due}', $client->name, $message);
            }
            if ($value == '{due_date}'){
                $message = str_replace('{due_date}', $invoice->due_date->format('M d Y'), $message);
            }
        }
        $template->body = $message;
        $template->subject = $subject;

        return response()->json($template, 200);
    }

    public function getTemplateQuotation(Request $request){
        $template = EmailTemplate::find($request->template_id);
        $message = $template->body;
        $quotation = Quotation::find($request->quotation_id);
        $client = $quotation->client;

        $subject = $template->subject;
        $subject = str_replace('{quotation_no}', 'QTN'.$quotation->id, $subject);

        foreach (config('config.TAGS') as $key => $value){
            if ($value == '{user_name}'){
                $message = str_replace('{user_name}', Auth::user()->name, $message);
            }
            if ($value == '{name}'){
                $message = str_replace('{name}', strtoupper($client->name), $message);
            }
            if ($value == '{email}'){
                $message = str_replace('{email}', $client->email, $message);
            }
            if ($value == '{company_name}'){
                $message = str_replace('{company_name}', $client->company_name, $message);
            }
            if ($value == '{phone}'){
                $message = str_replace('{phone}', $client->phone, $message);
            }
            if ($value == '{address}'){
                $message = str_replace('{address}', $client->address, $message);
            }
            if ($value == '{quotation_no}'){
                $message = str_replace('{quotation_no}', $quotation->id, $message);
            }
            if ($value == '{total_due}'){
                $message = str_replace('{total_due}', $client->name, $message);
            }
        }
        $template->body = $message;
        $template->subject = $subject;

        return response()->json($template, 200);
    }

    public function create(){
        if (!Gate::allows('create', 'email_template')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        return view('modules.email-template.create-email-template');
    }

    public function save(Request $request){
        if (!Gate::allows('create', 'email_template')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate([
            'subject' => 'required',
            'body' => 'required'
        ]);

        EmailTemplate::create([
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return redirect('admin/etemplate')->with(['success' => 'template created successfully']);
    }

    public function edit($id){
        if (!Gate::allows('update', 'email_template')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $template = EmailTemplate::find($id);
        return view('modules.email-template.edit-email-template')->with(['template'=>$template]);
    }

    public function update(Request $request, $id){
        if (!Gate::allows('update', 'email_template')){
            return response()->json(['message'=>'not authorized'], 403);
        }
        $request->validate([
            'subject' => 'required',
            'body' => 'required'
        ]);

        $template = EmailTemplate::find($id);
        $template->subject = $request->subject;
        $template->body = $request->body;
        $template->save();

        return redirect()->back()->with(['success' => 'template updated successfully']);
    }
}
