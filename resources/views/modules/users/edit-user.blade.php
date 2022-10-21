@extends('layout')

@section('title', 'Edit User')
@section('users-show', 'menu-open')

@section('content')
    <div class="content-wrapper">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 mt-5">
                <h1 class="panel-title">Update User</h1>
                <div class="col-lg-12 p-3">
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
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="/user/update/{{$user->id}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="user name">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="">Phone</label>
                                    <input name="phone" class="form-control" value="{{$user->phone}}">
                                    @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="physical_address" class="">Physical Address</label>
                                    <input id="physical_address" name="physical_address" class="form-control" value="{{$user->physical_address}}">
                                    @error('physical_address')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status" class="">Status</label>
                                    <input class="form-control" value="{{$user->status ? 'Active' : 'In-Active'}}" disabled>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_number">Id Number</label>
                                    <input class="form-control" id="id_number" name="id_number" value="{{$user->id_number}}">
                                    @error('id_number')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="user email">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role_id" class="form-control" id="role">
                                        <option value="">Please select a role</option>
                                        @foreach(\App\Models\Role::all() as $role)
                                            <option @if($user->role_id === $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection



