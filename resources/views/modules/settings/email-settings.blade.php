@extends('layout')

@section('title', 'Email Settings')
@section('settings-show', 'menu-open')
@section('email-settings', 'active')

@section('content')

    <div class="content-wrapper">
        <div class="container" style="margin-top:20px;">
            <div class="row">
                <div id="user" class="col-md-12">
                    <div class="panel panel-primary panel-table animated slideInDown">
                        <div class="panel-heading " style="padding:5px;">
                            <div class="row">
                                <div class="col col-xs-5 text-center">
                                    <h1 class="panel-title">Email Settings</h1>
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
                        </div>

                        <div class="container">

                            <div class="row">
                                <div class="col-md-8">
                                    <form action="/settings/email" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">Bank</div>
                                            <div class="col-md-6 form-group">
                                                <label for="bank">Bank</label>
                                                <input value="{{isset($settings['bank']) ? $settings['bank'] : ''}}" type="text" class="form-control" name="bank" id="bank"
                                                       placeholder="Input your bank name">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="branch">Branch</label>
                                                <input value="{{isset($settings['branch']) ? $settings['branch'] : ''}}" type="text" class="form-control" name="branch" id="branch"
                                                       placeholder="Input your bank branch">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_number">Acc Number</label>
                                                <input value="{{isset($settings['acc_number']) ? $settings['acc_number'] : ''}}" type="text" class="form-control" name="acc_number" id="acc_number"
                                                       placeholder="Input the bank account number">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_name">Acc Name</label>
                                                <input value="{{isset($settings['acc_name']) ? $settings['acc_name'] : ''}}" type="text" class="form-control" name="acc_name" id="acc_name"
                                                       placeholder="Input the bank account name">
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-12">Nostro 1</div>
                                            <div class="col-md-6 form-group">
                                                <label for="bank">Bank</label>
                                                <input value="{{isset($settings['nostro_1_bank']) ? $settings['nostro_1_bank'] : ''}}" type="text" class="form-control" name="nostro_1_bank" id="bank"
                                                       placeholder="Input your bank name">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="branch">Branch</label>
                                                <input value="{{isset($settings['nostro_1_branch']) ? $settings['nostro_1_branch'] : ''}}" type="text" class="form-control" name="nostro_1_branch" id="branch"
                                                       placeholder="Input your bank branch">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_number">Acc Number</label>
                                                <input value="{{isset($settings['nostro_1_acc_number']) ? $settings['nostro_1_acc_number'] : ''}}" type="text" class="form-control" name="nostro_1_acc_number" id="acc_number"
                                                       placeholder="Input the bank account number">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_name">Acc Name</label>
                                                <input value="{{isset($settings['nostro_1_acc_name']) ? $settings['nostro_1_acc_name'] : ''}}" type="text" class="form-control" name="nostro_1_acc_name" id="acc_name"
                                                       placeholder="Input the bank account name">
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-12">Nostro 2</div>
                                            <div class="col-md-6 form-group">
                                                <label for="bank">Bank</label>
                                                <input value="{{isset($settings['nostro_2_bank']) ? $settings['nostro_2_bank'] : ''}}" type="text" class="form-control" name="nostro_2_bank" id="bank"
                                                       placeholder="Input your bank name">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="branch">Branch</label>
                                                <input value="{{isset($settings['nostro_2_branch']) ? $settings['nostro_2_branch'] : ''}}" type="text" class="form-control" name="nostro_2_branch" id="branch"
                                                       placeholder="Input your bank branch">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_number">Acc Number</label>
                                                <input value="{{isset($settings['nostro_2_acc_number']) ? $settings['nostro_2_acc_number'] : ''}}" type="text" class="form-control" name="nostro_2_acc_number" id="acc_number"
                                                       placeholder="Input the bank account number">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_name">Acc Name</label>
                                                <input value="{{isset($settings['nostro_2_acc_name']) ? $settings['nostro_2_acc_name'] : ''}}" type="text" class="form-control" name="nostro_2_acc_name" id="acc_name"
                                                       placeholder="Input the bank account name">
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-12">Ecocash</div>
                                            <div class="col-md-6 form-group">
                                                <label for="ecco_number">Ecocash Number</label>
                                                <input value="{{isset($settings['ecco_number']) ? $settings['ecco_number'] : ''}}" type="text" class="form-control" name="ecco_number" id="ecco_number"
                                                       placeholder="Input your Ecocash Number">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="ecco_name">Ecocash Name</label>
                                                <input value="{{isset($settings['ecco_name']) ? $settings['ecco_name'] : ''}}" type="text" class="form-control" name="ecco_name" id="ecco_name"
                                                       placeholder="Input your ecocash name">
                                            </div>
                                            <div class="col-md-3 form-check">
                                                <input value="1" @if(isset($settings['show_eco']) && $settings['show_eco'] == 1) checked @endif type="checkbox" class="form-check-input" name="show_eco" id="show_eco">
                                                <label class="form-check-label" for="show_eco">Enable Ecocash</label>
                                            </div>
                                            <div class="col-md-3 form-check">
                                                <input value="1" @if(isset($settings['show_bank']) && $settings['show_bank'] == 1) checked @endif type="checkbox" class="form-check-input" name="show_bank" id="show_bank">
                                                <label class="form-check-label" for="show_bank">Enable Bank</label>
                                            </div>
                                            <div class="col-md-3 form-check">
                                                <input value="1" @if(isset($settings['show_nostro_1']) && $settings['show_nostro_1'] == 1) checked @endif type="checkbox" class="form-check-input" name="show_nostro_1" id="show_nostro_1">
                                                <label class="form-check-label" for="show_nostro_1">Enable Nostro 1</label>
                                            </div>
                                            <div class="col-md-3 form-check">
                                                <input value="1" @if(isset($settings['show_nostro_2']) && $settings['show_nostro_2'] == 1) checked @endif type="checkbox" class="form-check-input" name="show_nostro_2" id="show_nostro_2">
                                                <label class="form-check-label" for="show_nostro_2">Enable Nostro 2</label>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <button type="submit" class="btn btn-primary">Save Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>

                    </div><!--END panel-table-->
                </div>
            </div>
        </div>
    </div>

@endsection

