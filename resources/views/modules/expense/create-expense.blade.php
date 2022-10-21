@extends('layout')

@section('title', 'Create Expense')
@section('expense-show')
    menu-open
@endsection
@section('create-expense')
    active
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <h3>Create Expense</h3>
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
            <form action="/expense/save" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="add-client-form">
                            <div class="form-group">
                                <label for="title">Expense Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="write expense title">
                            </div>
                            <div class="form-group">
                                <label for="note">Expense Note</label>
                                <textarea rows="3" class="form-control" id="note" name="note" placeholder="Write expense note"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="amount">Expense Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="write expense amount">
                            </div>
                            <div class="form-group">
                                <label for="file">Expense Attachment</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Save Expense">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
