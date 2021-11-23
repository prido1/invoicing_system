@extends('layout')

@section('title', 'View Expense')
@section('expense-show')
    menu-open
@endsection
@section('view-expense')
    active
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <h3>View Expense</h3>
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
                <div class="row">
                    <div class="col-lg-6">
                        <div class="add-client-form">
                            <div class="form-group">
                                <label for="title">Expense Title</label>
                                <div class="form-control" id="title">{{$expense->title}}</div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="note">Expense Note</label>
                                <div class="form-control" id="title">{{$expense->note}}</div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="amount">Expense Amount</label>
                                <div class="form-control" id="title">${{$expense->amount}}</div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="file">Expense Attachment</label>
                                @if(!empty($expense->attachment))
                                    <div id="file" class="form-control mb-1">
                                        <img style="width: 100%" src="{{asset($expense->attachment)}}">
                                    </div>
                                    <a href="{{asset($expense->attachment)}}" class="btn btn-info">Download Attachment</a>
                                @else
                                    <div id="file" class="form-control mb-1">
                                       No attachment for this expense
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection
