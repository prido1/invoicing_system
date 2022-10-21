@extends('layout')

@section('title', 'Edit Roles & Permisions')
@section('users-show', 'menu-open')
@section('roles', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 mt-5">
                    <h4>Edit Role</h4>
                    <form action="{{route('role.update', $role->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{$role->name}}" class="form-control" name="name" id="name">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button class="btn btn-success" type="submit">Submin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


