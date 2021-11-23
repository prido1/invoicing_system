@extends('layout')

@section('title', 'Create Quotation')
@section('quotation-show')
    menu-open
@endsection
@section('edit-quotation')
    active
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="add-quotation-form">
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
                <form action="/admin/quotation/update/{{$quotation->id}}" method="post" enctype="multipart/form-data">
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
                                                <option @if(isset($quotation))
                                                        @if($quotation->client_id == $client->id)
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
                                <div class="input-group date" id="create-date" data-target-input="nearest">
                                    <input
                                        @if(isset($quotation)) value="{{\Carbon\Carbon::parse($quotation->create_date)->format('m/d/y')}}" @endif
                                    id="create-date" name="create_date" type="text"
                                        class="form-control datetimepicker-input" data-target="#create-date"/>
                                    <div class="input-group-append" data-target="#create-date"
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
                                          rows="3"> @if(isset($quotation)) {{$quotation->note}} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="terms">Terms & Conditions</label>
                                <textarea name="terms_conditions" id="terms" class="form-control"
                                          rows="3"> @if(isset($quotation)) {{$quotation->terms_condition}} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input @if(isset($quotation)) value="{{$quotation->discount}}" @endif id="discount"
                                       name="discount" class="form-control" value="0" placeholder="Discount">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="payment_currency">Payment Currency</label>
                                <select class="form-control" id="payment_currency" name="payment_currency">
                                    <option value="">Select Currency</option>
                                    @foreach($payment_currency as $currency)
                                        <option @if($quotation->payment_currency == $currency->id) selected @endif value="{{$currency->id}}">{{$currency->name}}</option>
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
                                        <option @if($quotation->payment_type == $type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 items_wrapper">
                            @foreach($quotation->items as $item)
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
                                        <input class="form-control" placeholder="Total Price" disabled>
                                    </div>
                                    <button class="btn btn-danger remove_btn"><i class="fa fa-trash"></i></button>
                                </div>
                            @endforeach
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
                                            <input @if(isset($quotation)) value="{{$total_price}}" @endif id="total" disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Discount</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input @if(isset($quotation)) value="{{$quotation->discount}}" @endif id="discountt" disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Grand Total</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input @if(isset($quotation)) value="{{$total_price - $quotation->discount}}" @endif id="grand_total" disabled class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2">
                                    <input type="button" class="btn btn-success" value="Save">
                                    <input type="submit" class="btn btn-primary" value="Save Send">
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
                <form action="/admin/client/save" method="post" enctype="multipart/form-data">
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
                    '                            <input class="form-control" placeholder="Total Price" disabled>\n' +
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
                    total = total + (quantity.val() * unit_price.val())
                    grand_total = total - discount;
                }
                discount_f.val(discount);
                total_f.val(total);
                grand_total_f.val(grand_total);
            }
        })


        //Date range picker
        $('#create-date').datetimepicker({
            allowInputToggle: true,
            format: 'L'
        });

        //Date range picker
        $('#due-date').datetimepicker({
            allowInputToggle: true,
            format: 'L'
        });
    </script>
@endpush
