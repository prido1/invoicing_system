@extends('layout')

@section('title', 'Imap Settings')
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
                                    <h1 class="panel-title">IMAP Settings</h1>
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
                                    <form action="/settings/imap/store" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">IMAP Settings</div>
                                            <div class="col-md-6 form-group">
                                                <label for="bank">Host</label>
                                                <input value="{{isset($settings['imap_host']) ? $settings['imap_host'] : ''}}" type="text" class="form-control" name="imap_host"
                                                       placeholder="Input your IMAP host">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="branch">Port</label>
                                                <input value="{{isset($settings['imap_port']) ? $settings['imap_port'] : ''}}" type="text" class="form-control" name="imap_port"
                                                       placeholder="Input your IMAP port">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="smtp_security">Imap Encryption</label>
                                                <select name="imap_encryption" id="smtp_security" class="form-control">
                                                    <option value="">Select SMTP Security</option>
                                                    <option @if(isset($settings['imap_encryption']) && $settings['imap_encryption'] == 'ssl') selected @endif value="ssl">SSL</option>
                                                    <option @if(isset($settings['imap_encryption']) && $settings['imap_encryption'] == 'tsl') selected @endif value="tsl">TSL</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_number">User</label>
                                                <input value="{{isset($settings['imap_user']) ? $settings['imap_user'] : ''}}" type="text" class="form-control" name="imap_user"
                                                       placeholder="Input your IMAP user">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_name">Password</label>
                                                <input value="{{isset($settings['imap_pass']) ? $settings['imap_pass'] : ''}}" type="text" class="form-control" name="imap_pass"
                                                       placeholder="Input your IMAP password">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="acc_name">Imap Sent Folder</label>
                                                <input value="{{isset($settings['imap_sent_folder']) ? $settings['imap_sent_folder'] : config('mail.imap.ImapSentFolder')}}" type="text" class="form-control" name="imap_sent_folder"
                                                       placeholder="Input your IMAP sent folder">
                                            </div>
                                            
                                            
                                            <div class="col-lg-12 mt-2">
                                                <button type="submit" class="btn btn-primary">Save Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-4">
                                    <form action="/settings/imap/test" method="post" enctype="multipart/form-data">
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

