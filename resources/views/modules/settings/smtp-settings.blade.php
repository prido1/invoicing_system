@extends('layout')

@section('title', 'Dashboard')
@section('settings-show')
    menu-open
@endsection
@section('smtp-settings')
    active
@endsection

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
                                        <form action="/admin/settings/smtp/store" method="post" enctype="multipart/form-data">
                                            @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="address">Address</label>
                                                <input value="{{isset($settings['from']['address']) ? $settings['from']['address'] : ''}}" type="email" class="form-control" name="address" id="address"
                                                       placeholder="Input your email address">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="address">Name</label>
                                                <input value="{{isset($settings['from']['name']) ? $settings['from']['name'] : ''}}" type="text" class="form-control" name="name" id="name"
                                                       placeholder="Input your full name">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="smtp_host">SMTP Host</label>
                                                <input value="{{isset($settings['smtp_host']) ? $settings['smtp_host'] : ''}}" type="text" class="form-control" name="smtp_host" id="smtp_host"
                                                       placeholder="Input the smtp host">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="port">Smtp Port</label>
                                                <input value="{{isset($settings['smtp_port']) ? $settings['smtp_port'] : ''}}" type="text" class="form-control" name="smtp_port" id="port"
                                                       placeholder="Input the smtp port">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="smtp_security">Smtp Security</label>
                                                <select name="smtp_security" id="smtp_security" class="form-control">
                                                    <option value="">Select SMTP Security</option>
                                                    <option @if(isset($settings['smtp_security']) && $settings['smtp_security'] == 'SSL') selected @endif value="SSL">SSL</option>
                                                    <option @if(isset($settings['smtp_security']) && $settings['smtp_security'] == 'TSL') selected @endif value="TSL">TSL</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="name">User Name</label>
                                                <input value="{{isset($settings['username']) ? $settings['username'] : ''}}" type="email" class="form-control" name="username" id="name"
                                                       placeholder="Input your full email">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                       id="password" placeholder="Type in your password">
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Save">
                                        </div>
                            </form>
                                    </div>

                                    <div class="col-md-4">
                                        <form action="/admin/settings/smtp/test" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="submit" class="ml-3 btn btn-primary" value="Test Connection">
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

