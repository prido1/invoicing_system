<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="_token" content="{{csrf_token()}}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css">
        #page-wrap {
            width: 700px;
            margin: 0 auto;
            padding-top: 50px;
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
        .no-border{
            border: hidden !important;
        }

        .no-border th{
            border-top: none !important;
        }
        .no-border td{
            border-top: none !important;
        }
        .no-border tr{
            border: hidden !important;
        }
        .company-details{
            text-align: right;
        }
        .company-details span{
            font-size: 12px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .company-details strong{
            white-space: nowrap;
        }
        #page-wrap-inner{
            padding: 20px;
        }

    </style>
</head>
<body>
<div id="page-wrap">
    <div id="page-wrap-inner">
        <table width="100%">
            <tr>
                <td width="40%">
                    <img style="width: 150px;height: auto" src="{{ asset($settings['logo'] ?? '') }}" class="">
                </td>
                <td width="60%" class="company-details">
                    <span style="font-size: 20px;"><strong>{{ $settings['app_name'] ?? '' }}</strong></span>
                    <span><strong>Address:  </strong>{{ $settings['app_address'] ?? '' }}</span>
                    <span>
                                    <strong>Email(s):  </strong>
                                    {!! implode('<br>', explode(',', $settings['app_email'])) !!}
                                </span>
                    <span> <strong>Phone Number(s):  </strong>{!! implode('<br>', explode(',', $settings['app_phone'])) !!}</span>
                </td>
            </tr>
        </table>


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

                    <table class="table table-striped no-border">
                        <tbody>
                        <tr>
                            <th class="table-label">Sub Total</th>
                            <td width="30%" class="table-amount text-right">{{ number_format($total_price, 2)}}</td>
                        </tr>
                        <tr>
                            <th class="table-label">Vat %</th>
                            <td width="30%" class="table-amount text-right">{{ number_format($invoice->vat, 2)}}</td>
                        </tr>
                        <tr>
                            <th class="table-label">Discount</th>
                            <td width="30%" class="table-amount text-right">{{ number_format($invoice->discount, 2)}}</td>
                        </tr>
                        <tr>
                            <th class="table-label">Grand Total</th>
                            <td width="30%" class="table-amount text-right">{{ number_format($total_price, 2) }}</td>
                        </tr>
                        </tbody>
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
                    {{-- @if(\Illuminate\Support\Facades\Auth::user()->signature_path)
                        <img style="width: 200px;height: 30px" src="{{asset(\Illuminate\Support\Facades\Auth::user()->signature_path)}}">
                    @endif --}}
                    <hr>
                    Authority Signature
                </td>
            </tr>
            </tbody>
        </table>
        <p style="text-align: center;font-style: italic"><small>{{$settings['app_moto']}}</small></p>
    </div>
</div>
</body>
</html>
