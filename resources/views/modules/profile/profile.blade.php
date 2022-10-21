@extends('layout')

@section('title', 'Profile')
@section('profile-show', 'menu-open')
@section('update-profile', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 mt-5">
                <h1 class="panel-title">Update Profile</h1>
                <div class="col-lg-12 p-3">
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
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="/profile/update" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6 ">
                                        <label for="name">Name</label>
                                        <input class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="user name">
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <label for="email">Email</label>
                                        <input class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="user email">
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" name="phone" value="{{$user->phone}}" placeholder="user phone">
                                        @error('phone')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror 
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Enter new password">
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <label for="file">Signature</label>
                                        <input type="file" class="form-control" id="file" name="file">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



