@extends('layout')

@section('title', 'Create Template')
@section('etemplate-show')
    menu-open
@endsection
@section('list-etemplate')
    active
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <h3>List Template</h3>
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
                    <th >id</th>
                    <th >subject</th>
                    <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                <tbody>
                @foreach($templates as $template)
                    <tr class="ok">
                        <td>ID{{$template->id}}</td>
                        <td>ID{{$template->subject}}</td>
                        <td>
                            <a href="/admin/etemplate/edit/{{$template->id}}" class="btn btn-primary" title="Edit Template"><i class="fa fa-pen"></i></a>
                    </tr>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="panel-footer text-center">
                <div class="mt-3">
                    {{$templates->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
