@extends('layout')

@section('title', 'Create Quotation')
@section('quotation-show')
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
    </style>
    <div class="row">
        <div class="col col-xs-5 text-center">
            <h1 class="panel-title">View Quotation</h1>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
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
        </div>
    </div>

    <div id="page-wrap">
        <div class="container">
            <div class="row">
                <div class="box-tools py-1">
                    <a href="/admin/quotation/edit/{{$quotation->id}}">
                        <button type="button" class="btn btn-flat margin-bottom pull-right bg-blue"
                                data-toggle="tooltip" title="{{ trans('Invoice::invoice.optional_title.edit') }}">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                    </a>
                    <button type="button" class="btn btn-flat margin-bottom bg-olive pull-right" data-toggle="modal"
                            data-target="#sendEmail" title="Send Email">
                        <i class="fa fa-envelope"></i> Send Email
                    </button>

                    <a href="/admin/quotation/print/{{$quotation->id}}" target="_blank" class="btn btn-flat margin-bottom bg-maroon pull-right"
                       title="Print Preview">
                        <i class="fa fa-envelope"></i> Print</a>


                </div>
            </div>
        </div>
        <div id="page-wrap-inner">
            <img style="width: 100%;height: auto" src="{{asset('bbb.png')}}" class="">

            <hr>
            <table width="100%">
                <tr>
                    <td width="50%">
                        <h4>Quotation To:</h4>
                        <address>
                            <strong>{{ $quotation->client->name }}</strong><br>
                            {{ $quotation->client->company_name}}<br>
                            {{ $quotation->client->address}}<br>
                            {{ $quotation->client->phone }}<br>
                            {{ $quotation->client->email }}<br>
                        </address>
                    </td>
                    <td width="50%">
                        <h2>Quotation Info</h2>
                        <table class="table table-striped table-bordered" width="100%">
                            <tbody>
                            <tr>
                                <th><b>Quotation ID:</b></th>
                                <td>#{{ $quotation->id }}</td>
                            </tr>
                            <tr>
                                <th><b>Payment Type:</b></th>
                                <td>{{ $quotation->paymentType->name }}</td>
                            </tr>
                            <tr>
                                <th><b>Payment Currency:</b></th>
                                <td>{{ $quotation->paymentCurrency->name }}</td>
                            </tr>
                            <tr>
                                <th><b>Created Date:</b></th>
                                <td>#{{ Carbon\Carbon::parse($quotation->create_date)->format('jS F Y ') }}</td>
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
                @foreach($quotation->items as $item)
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
                                <td class="table-amount text-right">{{ number_format($quotation->discount, 2)}}</td>
                            </tr>
                            {{--                        <tr>--}}
                            {{--                            <th class="table-label">Paid Amount</th>--}}
                            {{--                            <td class="table-amount text-right">{{ $quotation->currency->currency_symbol ? $quotation->currency->currency_symbol : isite()->siteCurrencySymbol() }}{{ number_format($quotation->payments->sum('paid_amount'),2)}}</td>--}}
                            {{--                        </tr>--}}
                            {{--                        <tr>--}}
                            {{--                            <th class="table-label">Due Amount</th>--}}
                            {{--                            <td class="table-amount text-right">{{ $quotation->currency->currency_symbol ? $quotation->currency->currency_symbol : isite()->siteCurrencySymbol() }}{{ number_format($quotation->grand_total - $quotation->payments->sum('paid_amount'), 2)}}</td>--}}
                            {{--                        </tr>--}}
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
                        @if($quotation->note)
                            <b>Note:</b>
                            <p class="text-muted well well-sm no-shadow">
                                {{ $quotation->note }}
                            </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        @if($quotation->terms_condition)
                            <b>Terms & Conditions:</b>
                            <p class="text-muted well well-sm no-shadow" style="">
                                {{ $quotation->terms_condition }}
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
                        @if(\Illuminate\Support\Facades\Auth::user()->signature_path)
                            <img style="width: 200px;height: 30px" src="{{asset(\Illuminate\Support\Facades\Auth::user()->signature_path)}}">
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
                <form action="/admin/quotation/send" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                    <div class="modal-header">
                        <h5>Send quotation</h5>
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
                                <input value="{{$quotation->client?->email}}" type="text" class="form-control" id="email" name="email"
                                       placeholder="email address">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                       placeholder="email subject">
                            </div>
                            <div class="form-group">
                                <label for="bodyy">Body</label>
                                <textarea rows="5" class="form-control textarea" id="bodyy" name="body"
                                          placeholder="email body"></textarea>
                            </div>
                            <div class="form-check">
                                <input name="attach" checked type="checkbox" class="form-check-input"
                                       id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Add Attachment</label>
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
    <script>
        $(function () {
            // Summernote
            $('.textarea').summernote()
        })
        function choose_template(e) {
            var template_id = e.target.value;
            var token = "<?php echo e(csrf_token()); ?>";
            var quotation_id = "<?php echo $quotation->id; ?>";
            var url = "/admin/etemplate/template/quotation"
            $.ajax({
                url: url,
                type: 'post',
                data: 'template_id=' + template_id + '&quotation_id='+quotation_id+ '&_token=' + token,
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
