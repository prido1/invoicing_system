@extends('layout')

@section('title', 'List Invoices')
@section('invoice-show')
    menu-open
@endsection
@section('list-invoice')
    active
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <form action="/admin/invoice/search" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input name="search_term" type="text" class="form-control" placeholder="Seach by client name, email or company name">
                            <span class="input-group-btn">
                                               <button type="submit" class="btn  btn-success "><i
                                                       class="fa fa-search"></i></button>
                                           </span>

                        </div>
                    </form>
                </div>
                <div class="col-lg-3">
                    <a href="/admin/invoice " class="btn btn-primary">All</a>
                </div>
            </div>
            <table class="table table-striped table-bordered table-list">
                <thead>
                <tr>
                    <th>id</th>
                    <th>client</th>
                    <th>company</th>
                    <th>created</th>
                    <th>due</th>
                    <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr class="ok">
                        <td>ID{{$invoice->id}}</td>
                        <td>{{$invoice->client->name}}</td>
                        <td>{{$invoice->client->company_name}}</td>
                        <td>{{\Carbon\Carbon::parse($invoice->create_date)->format('M d Y ')}}</td>
                        <td>{{Carbon\Carbon::parse($invoice->due_date)->format('M d Y')}}</td>
                        <td>
                            <a href="/admin/invoice/view/{{$invoice->id}}" class="btn btn-info" title="View invoice"><i class="fa fa-eye"></i></a>
                            <a href="/admin/invoice/edit/{{$invoice->id}}" class="btn btn-primary" title="Edit invoice"><i class="fa fa-pen"></i></a>
                            <a href="/admin/invoice/copy/{{$invoice->id}}" class="btn btn-success" title="Copy invoice"><i class="fa fa-copy"></i></a>
                    </tr>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="panel-footer text-center">
                <div class="mt-3">
                    {{$invoices->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
