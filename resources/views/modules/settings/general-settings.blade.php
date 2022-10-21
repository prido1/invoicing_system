@extends('layout') 

@section('title', 'General Settings')
@section('settings-show', 'menu-open')
@section('general-settings', 'active')

@section('content')

    <div class="content-wrapper">
        <div class="container" style="margin-top:20px;">
            <div class="row">
                <div id="user" class="col-md-12">
                    <div class="panel panel-primary panel-table animated slideInDown">
                        <div class="panel-heading " style="padding:5px;">
                            <div class="row">
                                <div class="col col-xs-5 text-center">
                                    <h1 class="panel-title">General Settings</h1>
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
                                    <form action="/settings/system/store" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row"> 
                                            <div class="col-md-6 form-group">
                                                <label for="app_name">App Name</label>
                                                <input value="{{isset($settings['app_name']) ? $settings['app_name'] : ''}}" type="text" class="form-control" name="app_name" id="app_name"
                                                       placeholder="Input your app name">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="app_email">Email</label>
                                                <input value="{{isset($settings['app_email']) ? $settings['app_email'] : ''}}" type="email" class="form-control" name="app_email" id="app_email"
                                                       placeholder="Input your app email">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="app_url">App Url</label>
                                                <input value="{{isset($settings['app_url']) ? $settings['app_url'] : ''}}" type="url" class="form-control" name="app_url" id="app_url"
                                                       placeholder="Input the app url">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="app_phone">App Phone</label>
                                                <input value="{{isset($settings['app_phone']) ? $settings['app_phone'] : ''}}" type="tel" class="form-control" name="app_phone" id="app_phone"
                                                       placeholder="Input the app phone">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="app_phone">App Moto</label>
                                                <input value="{{isset($settings['app_moto']) ? $settings['app_moto'] : ''}}" type="text" class="form-control" name="app_moto" id="app_moto"
                                                       placeholder="Input the app moto">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="app_address">Address</label>
                                                <input value="{{isset($settings['app_address']) ? $settings['app_address'] : ''}}" type="text" class="form-control" name="app_address" id="app_address"
                                                       placeholder="Input the company address">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="file">System Logo</label>
                                                <input type="file" class="form-control" id="file" name="logo">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="file">System Letter Head</label>
                                                <input type="file" class="form-control" id="file" name="letter_head">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="file">System Icon</label>
                                                <input type="file" class="form-control" id="file" name="icon">
                                            </div>

                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-primary" value="Save Changes">
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

