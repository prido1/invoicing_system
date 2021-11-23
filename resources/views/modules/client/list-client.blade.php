@extends('layout')

@section('title', 'Create Client')
@section('clients-show')
    menu-open
@endsection
@section('list-clients')
    active
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <h3>List Clients</h3>
            </div>
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <form action="/admin/client/search" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input name="term" type="text" class="form-control" placeholder="Seach by name, email or company name">
                            <span class="input-group-btn">
                                               <button type="submit" class="btn  btn-success "><i
                                                       class="fa fa-search"></i></button>
                                           </span>

                        </div>
                    </form>
                </div>
                <div class="col-lg-3">
                    <a href="/admin/client " class="btn btn-primary">All</a>
                </div>
            </div>
            <table class="table table-striped table-bordered table-list">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>company</th>
                    <th>email</th>
                    <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr class="ok">
                        <td>ID{{$client->id}}</td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->company_name}}</td>
                        <td>{{$client->email}}</td>
                        <td>
                            <a href="/admin/client/edit/{{$client->id}}" class="btn btn-primary" title="Edit invoice"><i class="fa fa-pen"></i></a>
                    </tr>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="panel-footer text-center">
                <div class="mt-3">
                    {{$clients->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
