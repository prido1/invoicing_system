@extends('layout')

@section('title', 'Create Invoice')
@section('invoice-show')
    menu-open
@endsection

@section('content')
    <style type="text/css">
        #page-wrap {
            width: 700px;
            margin: 0 auto;
            padding-top: 50px;
        }

        #page-wrap-inner {
            border: 1px solid lightblue;
        }

        .center-justified {
            text-align: justify;
            margin: 0 auto;
            width: 30em;
        }

        /*ini starts here*/
        .list-group {
            padding-left: 0;
            margin-bottom: 15px;
            width: auto;
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: 7.5px 10px;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid #ddd;
            /*margin: 2px;*/
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
            font-size: 12px;
        }

        td,
        th {
            padding: 0;
        }

        @media print {
            * {
                color: #000 !important;
                text-shadow: none !important;
                background: transparent !important;
                box-shadow: none !important;
            }

            a,
            a:visited {
                text-decoration: underline;
            }

            a[href]:after {
                content: " (" attr(href) ")";
            }

            abbr[title]:after {
                content: " (" attr(title) ")";
            }

            a[href^="javascript:"]:after,
            a[href^="#"]:after {
                content: "";
            }

            pre,
            blockquote {
                border: 1px solid #999;

                page-break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tr,
            img {
                page-break-inside: avoid;
            }

            img {
                max-width: 100% !important;
            }

            p,
            h2,
            h3 {
                orphans: 3;
                widows: 3;
            }

            h2,
            h3 {
                page-break-after: avoid;
            }

            select {
                background: #fff !important;
            }

            .navbar {
                display: none;
            }

            .table td,
            .table th {
                background-color: #fff !important;
            }

            .btn > .caret,
            .dropup > .btn > .caret {
                border-top-color: #000 !important;
            }

            .label {
                border: 1px solid #000;
            }

            .table {
                border-collapse: collapse !important;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #ddd !important;
            }
        }

        table {
            max-width: 100%;
            background-color: transparent;
            font-size: 12px;
        }

        th {
            text-align: left;
        }

        .table {
            width: 100%;
            margin-bottom: 10px;
        }

        .head {
            border-top: 0px solid #e2e7eb;
            border-bottom: 0px solid #e2e7eb;
        }

        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 5px;
            line-height: 1.428571429;
            vertical-align: top;
            border-top: 1px solid #e2e7eb;
        }

        /*ini edit default value : border top 1px to 0 px*/
        .table > thead > tr > th {
            font-size: 12px;
            font-weight: 500;
            vertical-align: bottom;
            color: #242a30;
        }

        .table > caption + thead > tr:first-child > th,
        .table > colgroup + thead > tr:first-child > th,
        .table > thead:first-child > tr:first-child > th,
        .table > caption + thead > tr:first-child > td,
        .table > colgroup + thead > tr:first-child > td,
        .table > thead:first-child > tr:first-child > td {
            border-top: 0;
        }

        .table > tbody + tbody {
            border-top: 2px solid #e2e7eb;
        }

        .table .table {
            background-color: #fff;
        }

        .table-condensed > thead > tr > th,
        .table-condensed > tbody > tr > th,
        .table-condensed > tfoot > tr > th,
        .table-condensed > thead > tr > td,
        .table-condensed > tbody > tr > td,
        .table-condensed > tfoot > tr > td {
            padding: 5px;
        }

        .table-bordered {
            border: 1px solid #e2e7eb;
        }

        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td {
            border: 1px solid #e2e7eb;
        }

        .table-bordered > thead > tr > th,
        .table-bordered > thead > tr > td {
            border-bottom-width: 2px;
        }

        .table-striped > tbody > tr:nth-child(odd) > td,
        .table-striped > tbody > tr:nth-child(odd) > th {
            background-color: #f0f3f5;
        }

        .panel-title {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 16px;
            color: #fff;
            padding: 0;
        }

        .panel-title > a {
            color: #707478;
            text-decoration: none;
        }

        a {
            background: transparent;
            color: #707478;
            text-decoration: none;
        }

        strong {
            color: #707478;
        }

        .total {
            float: left;
            color: #232A3F;
            margin-left: 80px;
            font-weight: 200;
        }

        .lead {
            font-size: 16px;
        }

        address {
            font-size: 14px;
        }
        .no-border{
            border-top: hidden !important;
        }

        .no-border th{
            border-top: hidden !important;
        }
        .no-border td{
            border-top: hidden !important;
        }
        .no-border tr{
            border-top: hidden !important;
        }
    </style>
    <div class="row">
        <div class="col col-xs-5 text-center">
            <h1 class="panel-title">Invoice View</h1>
        </div>
        <div class="col-lg-12">

        </div>
    </div>

    <div id="page-wrap">
        <div class="row">
            <div class="col-lg-12">
                @if(session('error'))
                    <div id="error_m" class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
                @if(session('success'))
                    <div id="success_m" class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="box-tools py-1">
                    <a href="/admin/invoice/edit/{{$invoice->id}}">
                        <button type="button" class="btn btn-flat margin-bottom pull-right bg-blue"
                                data-toggle="tooltip" title="{{ trans('Invoice::invoice.optional_title.edit') }}">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                    </a>
                    <button type="button" class="btn btn-flat margin-bottom bg-olive pull-right" data-toggle="modal"
                            data-target="#sendEmail" title="Send Email">
                        <i class="fa fa-envelope"></i> Send Email
                    </button>

                    <a href="/admin/invoice/print/{{$invoice->id}}" target="_blank" class="btn btn-flat margin-bottom bg-maroon pull-right"
                       title="Print Preview">
                        <i class="fa fa-envelope"></i> Print</a>

                    <button type="button" class="btn btn-flat margin-bottom btn-success pull-right" data-toggle="modal"
                            data-target="#myModal" title="Payment">
                        <i class="fa fa-credit-card"></i> Submit Payment
                    </button>

                </div>
            </div>
        </div>
        <div id="page-wrap-inner">
            <img style="width: 100%;height: auto" src="{{asset('bbb.png')}}" class="">

            <hr>
            <table width="100%">
                <tr>
                    <td width="50%">
                        <h2>Invoice To:</h2>
                        <address>
                            <strong>{{ $invoice->client->name }}</strong><br>
                            {{ $invoice->client->company_name}}<br>
                            {{ $invoice->client->address}}<br>
                            {{ $invoice->client->phone }}<br>
                            {{ $invoice->client->email }}<br>
                        </address>
                    </td>
                    <td width="50%">
                        <h2>Invoice Info</h2>
                        <table class="table table-striped table-bordered" width="100%">
                            <tbody>
                            <tr>
                                <th><b>Invoice No</b></th>
                                <td>#{{ $invoice->id }}</td>
                            </tr>
                            <tr>
                                <th><b>Payment Type:</b></th>
                                <td>{{ $invoice->paymentType->name }}</td>
                            </tr>
                            <tr>
                                <th><b>Payment Currency:</b></th>
                                <td>{{ $invoice->paymentCurrency->name }}</td>
                            </tr>
                            <tr>
                                <th><b>Created Date:</b></th>
                                <td>#{{ Carbon\Carbon::parse($invoice->create_date)->format('jS F Y ') }}</td>
                            </tr>
                            <tr>
                                <th><b>Due Date:</b></th>
                                <td>#{{ Carbon\Carbon::parse($invoice->due_date)->format('jS F Y ') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
            <br/><br/>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th width="60%" data-title="Description">Description</th>
                    <th width="15%" data-title="unit Price">Unit Price</th>
                    <th width="10%" data-title="Qty.">Qty.</th>
                    <th width="15%" data-title="Subtotal">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                        <td data-title="Description" class="table-name">{{$item->description}}</td>
                        <td data-title="Unit Price" class="table-price">{{ number_format($item->unit_price, 2)}}</td>
                        <td data-title="Quantity" class="table-qty">{{$item->quantity}}</td>
                        <td data-title="Subtotal"
                            class="table-total text-right">{{ number_format($item->quantity * $item->unit_price, 2)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <table width="100%">
                <tbody>
                <tr>
                    <td width="40%">
                                        @if($invoice->payment_status===1)
                                            <img style="margin:20px 0 20px 20px;" src="{{ asset('assets/invoice/img/paid.png') }}" alt="paid" width="200" height="80" >
                                        @elseif($invoice->payment_status===2)
                                            <img style="margin:20px 0 20px 20px;" src="{{ asset('assets/invoice/img/unpaid.png') }}" alt="unpaid" width="200" height="80" >
                                        @elseif($invoice->payment_status===3)
                                            <img style="margin:20px 0 20px 20px;" src="{{ asset('assets/invoice/img/canceled.png') }}" alt="canceled" width="200" height="80" >
                                        @elseif($invoice->payment_status===4)
                                            <img style="margin:20px 0 20px 20px;" src="{{ asset('assets/invoice/img/due.png') }}" alt="paid" width="200" height="80" >
                                        @elseif($invoice->payment_status===5)
                                            <img style="margin:20px 0 20px 20px;" src="{{ asset('assets/invoice/img/due.png') }}" alt="paid" width="200" height="80" >
                                        @endif
                    </td>
                    <td width="40%" style="float: right;">
                        <table class="table table-bordered">
                            <tfoot>
                            <tr>
                                <th class="table-label">Sub Total</th>
                                <td width="30%" class="table-amount text-right">{{ number_format($total_price, 2)}}</td>
                            </tr>
                            <tr>
                                <th class="table-label">Discount</th>
                                <td class="table-amount text-right">{{ number_format($invoice->discount, 2)}}</td>
                            </tr>
                            <tr>
                                <th class="table-label">Grand Total</th>
                                <td class="table-amount text-right">{{ number_format($total_price, 2) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table>
                <tr>
                    <td>
                        @if($invoice->note)
                        <b>Note:</b>
                        <p class="text-muted well well-sm no-shadow">
                            {{ $invoice->note }}
                        </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        @if($invoice->terms_condition)
                        <b>Terms & Conditions:</b>
                        <p class="text-muted well well-sm no-shadow" style="">
                            {{ $invoice->terms_condition }}
                        </p>
                        @endif
                    </td>
                </tr>
            </table>
            <br>
            <table width="100%">
                <tbody>
                <tr>

                    <td width="30%">
                        @if(config('config.EMAIL.show_bank') == 1)
                        <table width="100%">
                            <tr>
                                <td><h6>Bank Details</h6></td>
                            </tr>
                            <tr>
                                <th>Bank</th>
                                <td>{{config('config.EMAIL.bank')}}</td>
                            </tr>
                            <tr>
                                <th>Branch</th>
                                <td>{{config('config.EMAIL.branch')}}</td>
                            </tr>
                            <tr>
                                <th>ACC Name:</th>
                                <td>{{config('config.EMAIL.acc_name')}}</td>
                            </tr>
                            <tr>
                                <th>Acc no:</th>
                                <td>{{config('config.EMAIL.acc_number')}}</td>
                            </tr>
                        </table>
                        @endif
                    </td>

                    @if(config('config.EMAIL.show_nostro_1') == 1)
                    <td width="30%">
                        <table width="100%">
                            <tr>
                                <td><h6>Nostro Bank</h6></td>
                            </tr>
                            <tr>
                                <th>Bank</th>
                                <td>{{config('config.EMAIL.nostro_1_bank')}}</td>
                            </tr>
                            <tr>
                                <th>Branch</th>
                                <td>{{config('config.EMAIL.nostro_1_branch')}}</td>
                            </tr>
                            <tr>
                                <th>ACC Name:</th>
                                <td>{{config('config.EMAIL.nostro_1_acc_name')}}</td>
                            </tr>
                            <tr>
                                <th>Acc no:</th>
                                <td>{{config('config.EMAIL.nostro_1_acc_number')}}</td>
                            </tr>
                        </table>
                    </td>
                    @endif

                    @if(config('config.EMAIL.show_nostro_2') == 1)
                    <td width="30%">
                        <table width="100%">
                            <tr>
                                <td><h6>Nostro Bank</h6></td>
                            </tr>
                            <tr>
                                <th>Bank</th>
                                <td>{{config('config.EMAIL.nostro_2_bank')}}</td>
                            </tr>
                            <tr>
                                <th>Branch</th>
                                <td>{{config('config.EMAIL.nostro_2_branch')}}</td>
                            </tr>
                            <tr>
                                <th>ACC Name:</th>
                                <td>{{config('config.EMAIL.nostro_2_acc_name')}}</td>
                            </tr>
                            <tr>
                                <th>Acc no:</th>
                                <td>{{config('config.EMAIL.nostro_2_acc_number')}}</td>
                            </tr>
                        </table>
                    </td>
                    @endif

                    @if(config('config.EMAIL.show_eco') == 1)
                    <td width="30%" style="float: right;">
                        <table width="100%">
                            <tr>
                                <td><h6>Eocash Details</h6></td>
                            </tr>
                            <tr>
                                <th>Ecocash #</th>
                                <td>{{config('config.EMAIL.ecco_number')}}</td>
                            </tr>
                            <tr>
                                <th>Ecocash Name</th>
                                <td>{{config('config.EMAIL.ecco_name')}}</td>
                            </tr>
                        </table>
                    </td>
                    @endif

                </tr>
                </tbody>
            </table>

            <br>
            <table width="100%">
                <tbody>
                <tr>
                    <td width="30%">
                        <hr>
                        Client Signature
                    </td>
                    <td width="40%">

                    </td>
                    <td width="30%">
                       @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->signature_path)
                            <img style="width: 200px;height: 30px" src="{{asset(\Illuminate\Support\Facades\Auth::user()->signature_path)}}">
                        @elseif($invoice->user->signature_path)
                            <img style="width: 200px;height: 30px" src="{{asset($invoice->user->signature_path)}}">
                        @endif
                        <hr>
                        Authority Signature
                    </td>
                </tr>
                </tbody>
            </table>
            <p style="text-align: center;font-style: italic"><small>FOR COMMERCIAL & DOMESTIC TRANSPORT LOGISTICS</small></p>
        </div>
    </div>

    <div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="add client"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/admin/invoice/send" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                    <div class="modal-header">
                        <h5>Send Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="add-client-form">
                            <div class="form-group">
                                <label for="temp">Select Template</label>
                                <select id="temp" class="form-control" onchange="choose_template(event)">
                                    <option>Select Template</option>
                                    @foreach($templates as $template)
                                        <option value="{{$template->id}}">{{$template->subject}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input disabled value="{{$invoice->client?->email}}" type="email" class="form-control" id="email" name="email"
                                       placeholder="email address">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input
                                    @if($invoice->email_subject)
                                        value="{{$invoice->email_subject}}"
                                    @endif
                                    type="text" class="form-control" id="subject" name="subject"
                                       placeholder="email subject">
                            </div>
                            <div class="form-group">
                                <label for="bodyy">Body</label>
                                <textarea rows="5" class="form-control textarea" id="bodyy" name="body"
                                          placeholder="email body">
                                      @if($invoice->email_body)
                                        {{$invoice->email_body}}
                                    @endif
                                </textarea>
                            </div>
                            <div class="form-check">
                                <input name="attach"
                                       @if($invoice->attach)
                                           checked
                                       @elseif(!$invoice->attach)
                                       checked="false"
                                       @else
                                          checked
                                       @endif
                                       type="checkbox" class="form-check-input"
                                       id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Add Attachment</label>
                            </div>
                            <div class="form-check">
                                <input
                                    @if($invoice->is_scheduled)
                                    checked
                                    @endif
                                    onchange="scheduleEmail(event)" name="schedule" type="checkbox" class="form-check-input"
                                       id="schedule">
                                <label class="form-check-label" for="schedule">Schedule</label>
                            </div>
                           <div class="row @if(!$invoice->is_scheduled)
                               hidden
                                           @endif" id="schedule_invoice">
                               <div class="form-group col-lg-6">
                                   <label for="schedule_date">Schedule Date</label>
                                   <div class="input-group date" id="schedule_date" data-target-input="nearest">
                                       <input value="
                                        @if($invoice->is_scheduled)
                                           {{$invoice->schedule_date}}
                                           @endif
                                           " name="schedule_date" type="text"
                                              class="form-control datetimepicker-input" data-target="#schedule_date"/>
                                       <div class="input-group-append" data-target="#schedule_date"
                                            data-toggle="datetimepicker">
                                           <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                       </div>
                                   </div>
                               </div>
                           </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

    </script>
    <script>

        $(function () {
            // Summernote
            $('.textarea').summernote();
            //Date range picker
            $('#schedule_date').datetimepicker({
                allowInputToggle: true,
                format: 'YYYY-MM-DD HH:mm:ss',
                icons: {
                    time: 'fa fa-clock',
                    date: 'fa fa-calendar',
                    up: 'fa fa-arrow-up',
                    down: 'fa fa-arrow-down',
                }
            });
        })

        function scheduleEmail(e) {
            if (e.target.checked){
                $('#schedule_invoice').removeClass('hidden');
            }

            if (!e.target.checked){
                $('#schedule_invoice').addClass('hidden');
            }
        }

        function recurringEmail(e) {
            if (e.target.checked){
                $('#recurring_invoice').removeClass('hidden');
            }

            if (!e.target.checked){
                $('#recurring_invoice').addClass('hidden');
            }
        }

        function choose_template(e) {
            var template_id = e.target.value;
            var token = "<?php echo e(csrf_token()); ?>";
            var invoice_id = "<?php echo $invoice->id; ?>";
            var url = "/admin/etemplate/template"
            $.ajax({
                url: url,
                type: 'post',
                data: 'template_id=' + template_id + '&invoice_id='+invoice_id+ '&_token=' + token,
                dataType: 'json'
            })
                .done(function (response) {
                    var subject = $('#subject');
                    var body = $('#bodyy');
                    subject.val(response.subject);
                    body.summernote('code','<p></p>');
                    body.summernote('code',response.body);
                })

        }

    </script>
@endpush
