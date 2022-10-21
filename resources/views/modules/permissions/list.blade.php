

@extends('layout')

@section('title', 'List Permissions')
@section('users-show', 'menu-open')
@section('permissions', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 mt-5">
                    <h4>List Permissions</h4>
            <div class="">
                <h4 class="float-right"><a class="btn btn-primary" href="{{route('permission.create')}}">Add New</a></h4>

                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">role</th>
                        <th scope="col">action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <th scope="row">{{$permission->role->name}}</th>
                            <th scope="row">
                                <form action="{{route('permission.destroy',$permission->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('permission.edit', $permission->id)}}" class="btn btn-warning">Edit</a>
                                        <button class="btn btn-danger">Delete</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                </div>
            </div>
        </div>
    </div>

@endsection




