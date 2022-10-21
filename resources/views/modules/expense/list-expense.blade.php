@extends('layout')

@section('title', 'Create Expense')
@section('expense-show')
    menu-open
@endsection
@section('list-expense')
    active
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <h3>List Expenses</h3>
            </div>
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
            <table class="table table-striped table-bordered table-list">
                <thead>
                <tr>
                    <th width="10%">id</th>
                    <th width="50%">title</th>
                    <th width="20%">amount</th>
                    <th width="20%">date</th>
                    <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                <tbody>
                @foreach($expenses as $expense)
                    <tr class="ok">
                        <td>ID{{$expense->id}}</td>
                        <td>{{$expense->title}}</td>
                        <td>${{$expense->amount}}</td>
                        <td>{{$expense->created_at->format('M d Y h:m')}}</td>
                        <td>
                            <a href="/expense/view/{{$expense->id}}" class="btn btn-primary" title="View Expense"><i class="fa fa-eye"></i></a>
                    </tr>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="panel-footer text-center">
                <div class="mt-3">
                    {{$expenses->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
