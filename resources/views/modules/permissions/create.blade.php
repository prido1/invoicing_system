@extends('layout')

@section('title', 'Create Permission')
@section('users-show', 'menu-open')
@section('permissions', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-10 mt-5">
                    <h4>create Permissions</h4>
                    <form action="{{route('permission.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <select name="role_id" class="form-control">
                                        <option value="">Please select a role</option>
                                        @foreach(\App\Models\Role::all() as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                            <div class="col-md-8 col-lg-8">
                                <table class="table table-bordered">
                                    <thead class="">
                                    <tr>
                                        <th scope="col">Permission</th>
                                        <th scope="col">create</th>
                                        <th scope="col">update</th>
                                        <th scope="col">Read</th>
                                        <th scope="col">Delete</th>
                                        <th scope="col">List</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th class="text-center" scope="row">Roles</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[role][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[role][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[role][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[role][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[role][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Permission</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[permission][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[permission][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[permission][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[permission][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[permission][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Activity Log</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[activityLog][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[activityLog][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[activityLog][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[activityLog][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[activityLog][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">User</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[user][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[user][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[user][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[user][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[user][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Clients</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[client][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[client][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[client][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[client][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[client][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Invoice</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[invoice][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[invoice][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[invoice][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[invoice][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[invoice][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Quotation</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[quotation][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[quotation][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[quotation][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[quotation][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[quotation][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Expense</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[expense][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[expense][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[expense][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[expense][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[expense][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Settings</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[setting][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[setting][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[setting][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[setting][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[setting][list]" value="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Email Templates</th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[email_template][create]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[email_template][update]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[email_template][read]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[email_template][delete]" value="1"></th>
                                        <th class="text-center" scope="row"><input type="checkbox" name="permission[email_template][list]" value="1"></th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


