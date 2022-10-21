@extends('layout')

@section('title', 'Create Client')
@section('clients-show')
    menu-open
@endsection
@section('create-clients')
    active
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <h3>Create Client</h3>
            </div>
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
           <form action="/client/save" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row">
                   <div class="col-lg-6">
                       <div class="add-client-form">
                           <div class="form-group">
                               <label for="name">Full Name</label>
                               <input class="form-control" id="name" name="name" placeholder="client name">
                           </div>
                           <div class="form-group">
                               <label for="company_name">Company Name</label>
                               <input class="form-control" id="company_name" name="company_name" placeholder="company name">
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
                           <input type="submit" class="btn btn-primary" value="Save Client">
                       </div>
                   </div>
               </div>
           </form>
        </div>
    </div>

@endsection
