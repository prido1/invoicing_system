@extends('layout')

@section('title', 'Dashboard')
@section('staff-show')
    menu-open
@endsection
@section('roles')
    active
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <h4>Add New Role</h4>
                    <form action="{{route('admin.role.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
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


