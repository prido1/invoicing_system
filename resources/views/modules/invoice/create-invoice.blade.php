@extends('layout')

@section('title', 'Create Invoice')
@section('invoice-show', 'menu-open')
@section('create-invoice', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="add-invoice-form">
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
                <form action="/invoice/save" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="client">Select Client</label>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="input-group-append" data-target="#client"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text" data-toggle="modal"
                                                 data-target="#add_client"><i class="fa fa-plus"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <select id="client" name="client_id" class="form-control select2 w-100">
                                            <option>Select Client</option>
                                            @foreach($clients as $client)
                                                <option @if(isset($invoice))
                                                        @if($invoice->client_id == $client->id)
                                                        selected
                                                        @endif
                                                        @endif value="{{$client->id}}">{{$client->name}}
                                                    ({{$client->company_name}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="create-date">Create Date</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input
                                        @if(isset($invoice)) value="{{\Carbon\Carbon::parse($invoice->create_date)->format('m/d/y')}}" @endif
                                    id="create-date" name="create_date" type="text"
                                        class="form-control datetimepicker-input" data-target="#create-date"/>
                                    <div class="input-group-append" data-target="#create-date"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="due-date">Due Date</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input
                                        @if(isset($invoice)) value="{{\Carbon\Carbon::parse($invoice->due_date)->format('m/d/y')}}" @endif
                                    id="due-date" name="due_date" type="text"
                                        class="form-control datetimepicker-input" data-target="#due-date"/>
                                    <div class="input-group-append" data-target="#due-date"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" class="form-control"
                                          rows="3"> @if(isset($invoice)) {{$invoice->note}} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="terms">Terms & Conditions</label>
                                <textarea name="terms_conditions" id="terms" class="form-control"
                                          rows="3"> @if(isset($invoice)) {{$invoice->terms_condition}} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input @if(isset($invoice)) value="{{$invoice->discount}}" @endif id="discount"
                                       name="discount" class="form-control" value="0" placeholder="Discount">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="discount">Vat %</label>
                                <input @if(isset($invoice)) value="{{$invoice->vat}}" @endif id="vat"
                                       name="vat" class="form-control" value="0" placeholder="Vat in %">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="payment_currency">Payment Currency</label>
                                <select class="form-control" id="payment_currency" name="payment_currency">
                                    <option value="">Select Currency</option>
                                    @foreach($payment_currency as $currency)
                                        <option @if(isset($invoice) && $invoice->payment_currency == $currency->id) selected @endif value="{{$currency->id}}">{{$currency->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="payment_type">Payment Type</label>
                                <select class="form-control" id="payment_type" name="payment_type">
                                    <option value="">Select Type</option>
                                    @foreach($payment_type as $type)
                                        <option @if(isset($invoice) && $invoice->payment_type == $type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="payment_status">Payment Status</label>
                                <select class="form-control" id="payment_status" name="payment_status">
                                    <option value="">Select Status</option>
                                    @foreach($payment_status as $status)
                                        <option @if(isset($invoice) && $invoice->payment_status == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 items_wrapper">
                            @if(!isset($invoice))
                                <div class="row py-1" id="items_row_1">
                                    <div class="col-lg-2">
                                        <input name="quantity[]" value="1" class="form-control quantity"
                                               placeholder="Quantity">
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="description[]" class="form-control description"
                                               placeholder="Description">
                                    </div>
                                    <div class="col-lg-2">
                                        <input name="unit_price[]" class="form-control unit_price"
                                               placeholder="Unit Price">
                                    </div>
                                    <div class="col-lg-2">
                                        <input class="form-control total_price" placeholder="Total Price" disabled>
                                    </div>
                                </div>
                            @endif
                            @if(isset($invoice))
                                @foreach($invoice->items as $item)
                                    <div class="row py-1" id="items_row_1">
                                        <div class="col-lg-2">
                                            <input name="quantity[]" value="{{$item->quantity}}" class="form-control quantity"
                                                   placeholder="Quantity">
                                        </div>
                                        <div class="col-lg-5">
                                            <input name="description[]" value="{{$item->description}}" class="form-control description"
                                                   placeholder="Description">
                                        </div>
                                        <div class="col-lg-2">
                                            <input name="unit_price[]" value="{{$item->unit_price}}" class="form-control unit_price"
                                                   placeholder="Unit Price">
                                        </div>
                                        <div class="col-lg-2">
                                            <input class="form-control total_price" placeholder="Total Price" disabled>
                                        </div>
                                        <button class="btn btn-danger remove_btn"><i class="fa fa-trash"></i></button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-lg-12 mt-2">
                            <button type="button" class="btn btn-primary add_btn"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-7"></div>
                                <div class="col-lg-5">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Total</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input @if(isset($invoice)) value="{{$total_price}}" @endif id="total" disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Vat %</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input @if(isset($invoice)) value="{{$invoice->vat}}" @endif id="vat_total" disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Discount</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input @if(isset($invoice)) value="{{$invoice->discount}}" @endif id="discountt" disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Grand Total</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input @if(isset($invoice)) value="{{($invoice->vat / 100 + 1) * ($total_price - $invoice->discount)}}" @endif id="grand_total" disabled class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2">
                                    <input type="submit" class="btn btn-success" value="Save Invoice">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_client" tabindex="-1" role="dialog" aria-labelledby="add client"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/client/save" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5>Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="add-client-form">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input class="form-control" id="name" name="name" placeholder="client name">
                            </div>
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input class="form-control" id="company_name" name="company_name"
                                       placeholder="company name">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" id="phone" name="phone" placeholder="company phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" id="address" name="address" placeholder="company address">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input class="form-control" id="email" name="email" placeholder="company email address">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        $(document).ready(function () {
            var count = 1;
            var total = 0;
            var grand_total = 0;
            var discount = 0;
            var addBtn = '.add_btn';
            var wrapper = '.items_wrapper';
            var total_f = $('#total');
            var grand_total_f = $('#grand_total');
            var discount_f = $('#discountt');
            var discount_ff = $('#discount');

            $(addBtn).click(function () {
                count++;
                $(wrapper).append(' <div class="row py-1" id="items_row_' + count + '">\n' +
                    '                        <div class="col-lg-2">\n' +
                    '                            <input name="quantity[]" value="1" class="form-control quantity" placeholder="Quantity">\n' +
                    '                        </div>\n' +
                    '                        <div class="col-lg-5">\n' +
                    '                            <input name="description[]" class="form-control description" placeholder="Description">\n' +
                    '                        </div>\n' +
                    '                        <div class="col-lg-2">\n' +
                    '                            <input name="unit_price[]" class="form-control unit_price" placeholder="Unit Price">\n' +
                    '                        </div>\n' +
                    '                        <div class="col-lg-2">\n' +
                    '                            <input class="form-control total_price" placeholder="Total Price" disabled>\n' +
                    '                        </div>\n' +
                    '                            <button class="btn btn-danger remove_btn"><i class="fa fa-trash"></i></button>\n' +
                    '                    </div>');
            })

            $(wrapper).on('click', '.remove_btn', function (e) {
                e.preventDefault();
                count--;
                $(this).parent('div').remove();
                calculate();
            })

            $(wrapper).on('keyup', '.quantity', function () {
                calculate();
            });
            $(document).on('keyup', '#vat', function () {
                calculate();
            });
            $(wrapper).on('keyup', '.unit_price', function () {
                calculate();
            });
            $('#discount').keyup(function () {
                calculate();
            })

            function calculate() {
                total = 0;
                grand_total = 0;
                discount = discount_ff.val();
                for (let i = 1; i < count + 1; i++) {
                    var wrap = $('#items_row_' + i);
                    var quantity = wrap.find('.quantity');
                    var unit_price = wrap.find('.unit_price');
                    var total_price = wrap.find('.total_price');
                    total = total + (quantity.val() * unit_price.val())
                    grand_total = total - discount;
                    total_price.val(quantity.val() * unit_price.val())
                }
                let vat = $('#vat');
                let vat_total = $('#vat_total');
                vat_total.val(vat.val());

                discount_f.val(discount);
                total_f.val(total);
                grand_total = (vat.val() / 100 + 1) * grand_total;
                grand_total = Math.round(grand_total * 100) / 100;
                grand_total_f.val(grand_total);
            }
        })
 

        //Date range picker
        $('#create-date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true,
            startDate: moment().subtract(6, 'days')
        });

        //Date range picker
        $('#due-date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true,
            startDate: moment().subtract(6, 'days')
        });
    </script>
@endpush
