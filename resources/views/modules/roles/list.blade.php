@extends('layout')

@section('title', 'Dashboard')
@section('users-show')
    menu-open
@endsection
@section('roles')
    active
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 mt-5">
                    <h4>List All Roles</h4>

                <h4 class="float-right"><a class="btn btn-primary" href="{{route('admin.role.create')}}">Add New</a></h4>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <th scope="roe">{{$loop->iteration}}</th>
                            <th scope="roe">{{$role->name}}</th>
                            <th scope="roe">
                                <form action="{{route('admin.role.destroy',$role->id)}}" method="post" >
                                    @method('delete')
                                    @csrf
                                    <a href="{{route('admin.role.edit', $role->id)}}" class="btn btn-warning">Edit</a>
                                        <button type="submit" class="btn btn-danger">Delete</button>
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

@endsection


