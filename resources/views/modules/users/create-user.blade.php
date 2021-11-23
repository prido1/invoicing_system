@extends('layout')

@section('title', 'Dashboard')
@section('users-show')
    menu-open
@endsection
@section('create-user')
    active
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 mt-5">
                <h1 class="panel-title">Create User</h1>
                <div class="col-lg-12 p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="/admin/user/save" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" name="name" placeholder="user name">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" name="email" placeholder="user email">
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
                                            <option value="{{$role->id}}">{{$role->name}}</option>
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



