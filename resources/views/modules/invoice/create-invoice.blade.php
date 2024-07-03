@extends('layout')

@section('title', 'Create Invoice')
@section('invoice-show', 'menu-open')
@section('create-invoice', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="add-invoice-form" style="position: relative;">
                <div class="loading-container">
                    <div class="lds-hourglass"></div>
                </div>
                <form id="invoice_form" method="post" enctype="multipart/form-data">
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
                                        <select id="client" name="client_id" class="form-control client_id select2 w-100">
                                            <option value="">Select Client</option>
                                            @foreach($clients as $client)
                                                <option
                                                    value="{{$client->id}}">{{$client->name}}
                                                    ({{$client->company_name}})
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback client_id"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="create-date">Create Date</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input
                                        value=""
                                        id="create-date" name="create_date" type="text"
                                        class="form-control create_date datetimepicker-input" data-target="#create-date"/>
                                    <div class="input-group-append" data-target="#create-date"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <span class="invalid-feedback create_date"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="due-date">Due Date</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input
                                        value=""
                                        id="due-date" name="due_date" type="text"
                                        class="form-control due_date datetimepicker-input" data-target="#due-date"/>
                                    <div class="input-group-append" data-target="#due-date"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <span class="invalid-feedback due_date"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" class="form-control note"
                                          rows="3"> </textarea>
                                <span class="invalid-feedback note"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="terms">Terms & Conditions</label>
                                <textarea name="terms_conditions" id="terms" class="form-control terms_conditions"
                                          rows="3"></textarea>
                                <span class="invalid-feedback terms_conditions"></span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input value="" id="discount"
                                       name="discount" class="form-control discount" placeholder="Discount">
                                <span class="invalid-feedback discount"></span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="discount">Vat %</label>
                                <input value="" id="vat"
                                       name="vat" class="form-control vat" placeholder="Vat in %">
                                <span class="invalid-feedback vat"></span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="payment_currency">Payment Currency</label>
                                <select class="form-control payment_currency" id="payment_currency" name="payment_currency">
                                    <option value="">Select Currency</option>
                                    @foreach($payment_currency as $currency)
                                        <option
                                            value="{{$currency->id}}">{{$currency->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback payment_currency"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="payment_type">Payment Type</label>
                                <select class="form-control payment_type" id="payment_type" name="payment_type">
                                    <option value="">Select Type</option>
                                    @foreach($payment_type as $type)
                                        <option
                                            value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback payment_type"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="payment_status">Payment Status</label>
                                <select class="form-control payment_status" id="payment_status" name="payment_status">
                                    <option value="">Select Status</option>
                                    @foreach($payment_status as $status)
                                        <option
                                            value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback payment_status"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 items_wrapper">
                            <div class="row py-1" id="items_row_0">
                                <div class="col-lg-2">
                                    <input name="quantity[]" value="1" class="form-control quantity quantity_0"
                                           placeholder="Quantity">
                                    <span class="invalid-feedback quantity_0"></span>
                                </div>
                                <div class="col-lg-5">
                                    <input name="description[]" class="form-control description_0"
                                           placeholder="Description">
                                    <span class="invalid-feedback description_0"></span>
                                </div>
                                <div class="col-lg-2">
                                    <input name="unit_price[]" class="form-control unit_price unit_price_0"
                                           placeholder="Unit Price">
                                    <span class="invalid-feedback unit_price_0"></span>
                                </div>
                                <div class="col-lg-2">
                                    <input class="form-control total_price" placeholder="Total Price" disabled>
                                </div>
                            </div>
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
                                            <input name="total" id="total"
                                                   disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Vat %</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input name="vat_total" id="vat_total"
                                                   disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Discount</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input
                                                name="discount" id="discountt" disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span>Grand Total</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <input name="grand_total"
                                                   id="grand_total" disabled class="form-control">
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

        $('#invoice_form').on('submit', function (e) {
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('.loading-container').css('display', 'flex');
            var formData = $(this).serialize();

            $.ajax({
                url: '{{route('invoice.save')}}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('.loading-container').hide();
window.location.href = response.redirect;
                },
                error: function (xhr) {
                    $('.loading-container').hide();
                    if (xhr.status === 422) {
                        // Display validation errors
                        var errors = xhr.responseJSON.errors;

                        for (const key in errors) {console.log(key.replace('.', '_'))
                            let span = $(`.${key.replace('.', '_')}.invalid-feedback`);
                            span.text(`${errors[key][0]}`);
                            const previousElement = $('.form-control.'+key.replace('.', '_'));
                            previousElement.addClass('is-invalid')
                        }
                    } else {
                        // Handle other errors
                    }
                }
            });
        });

        $(document).ready(function () {
            var count = 0;
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
                $(wrapper).append(
                    `<div class="row py-1" id="items_row_${count}">
                                <div class="col-lg-2">
                                    <input name="quantity[]" value="1" class="form-control quantity quantity_${count}"
                                           placeholder="Quantity">
                                    <span class="invalid-feedback quantity_${count}"></span>
                                </div>
                                <div class="col-lg-5">
                                    <input name="description[]" class="form-control description_${count}"
                                           placeholder="Description">
                                    <span class="invalid-feedback description_${count}"></span>
                                </div>
                                <div class="col-lg-2">
                                    <input name="unit_price[]" class="form-control unit_price unit_price_${count}"
                                           placeholder="Unit Price">
                                    <span class="invalid-feedback unit_price_${count}"></span>
                                </div>
                                <div class="col-lg-2">
                                    <input class="form-control total_price" placeholder="Total Price" disabled>
                                </div>
                            </div>`
                )
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
                for (let i = 0; i < count + 1; i++) {
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
                // grand_total_f.val(grand_total);
                const myInput = document.getElementById('grand_total');


                myInput.value = grand_total;
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
