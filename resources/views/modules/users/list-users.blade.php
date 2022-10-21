@extends('layout')

@section('title', 'List Users')
@section('users-show', 'menu-open')
@section('list-user', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 mt-5">
                    <h4>List All Staff</h4>
                    @can('create', 'staff')
                        <h4 class="float-right"><a class="btn btn-primary" href="/create-user?staff">Add New</a></h4>
                    @endcan
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">role</th>
                            <th scope="col">action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <th scope="row">{{$user->name}}</th>
                                <th scope="row">{{$user->email}}</th>
                                <th scope="row">{{isset($user->role) ? $user->role->name : ''}}</th>
                                <th scope="row">

                                        <a id="status_{{$user->id}}" href="javascript:void(0)" class="btn {{$user->status == 1 ? 'btn-warning' : 'btn-success'}}"
                                           onclick="user_status('{{ $user->id }}', '{{$user->status == 1 ? 0 : 1}}')"><i class="fa {{$user->status == 1 ? 'fa-ban' : 'fa-check-square'}}"   ></i></a>
                                        <a href="/user/edit/{{$user->id}}" class="btn btn-info"><i class="fa fa-pen"></i></a>
                                        <a href="javascript:void(0)"
                                           onclick="delete_item('{{ $user->id }}')" class="btn btn-danger"  title="delete"><i class="fa fa-trash" ></i></a>

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


@push('scripts')
    <script type="text/javascript">
        function delete_item(user_id) {
            var table_row = '#row_'+user_id;
            var token =  "<?php echo e(csrf_token()); ?>";
            url = "<?php echo e(route('user.delete')); ?>"

            swal({
                title: "<?php echo e(__('are_you_sure?')); ?>",
                text: "<?php echo e(__('it_will_be_deleted_permanently')); ?>",
                icon: "warning",
                buttons: true,
                showCancelButton: true,
                confirmButtonColor: '#0000ff',
                cancelButtonColor: '#ff0000',
                closeOnClickOutside: false
            })
                .then(function(confirmed){
                    if (confirmed){
                        $.ajax({
                            url: url,
                            type: 'delete',
                            data: 'user_id=' + user_id +'&_token='+token,
                            dataType: 'json'
                        })
                            .done(function(response){
                                console.log(response);
                                swal.stopLoading();
                                if(response.status == "success"){
                                    console.log(response);
                                    swal("<?php echo e(__('deleted')); ?>!", response.message, response.status);
                                    $(table_row).fadeOut(2000);

                                }else{
                                    swal("Error!", response.message, response.status);
                                }
                            })
                            .fail(function(){
                                swal('Oops...', '<?php echo e(__('something_went_wrong_with_ajax')); ?>', 'error');
                            })
                    }
                })
        }
        function user_status(user_id, action) {
            var row= '#status_'+user_id;
            var token =  "<?php echo e(csrf_token()); ?>";
            url = "<?php echo e(route('user.status')); ?>"
            var displayAction = action == 1 ? 'true' : 'false';

            swal({
                title: "<?php echo e(__('are_you_sure ?')); ?>",
                icon: "warning",
                buttons: true,
                showCancelButton: true,
                confirmButtonColor: '#0000ff',
                cancelButtonColor: '#ff0000',
                closeOnClickOutside: false
            })
                .then(function(confirmed){
                    if (confirmed){
                        $.ajax({
                            url: url,
                            type: 'post',
                            data: 'user_id=' + user_id +'&_token='+token+'&action='+action,
                            dataType: 'json'
                        })
                            .done(function(response){
                                swal.stopLoading();
                                if(response.status == "success"){
                                    swal('success'+'!', response.message, response.status);
                                    var $status_col = $('#status_col_'+user_id).find('span');
                                    var $i = $(row).find('i');
                                    if(action == 1 ){
                                        $(row).removeClass();
                                        $(row).addClass('btn btn-warning');

                                        $i.removeClass();
                                        $i.addClass('fa fa-ban')

                                        $status_col.removeClass();
                                        $status_col.addClass('status-active')
                                        $status_col.text(displayAction)
                                        window.location.reload();
                                    }else if(action == 0 ){
                                        $(row).removeClass();
                                        $(row).addClass('btn btn-success');
                                        $i.removeClass();
                                        $i.addClass('fa fa-check-square')

                                        $status_col.removeClass();
                                        $status_col.addClass('status-in-active')
                                        $status_col.text(displayAction);
                                        window.location.reload();
                                    }

                                }else{
                                    swal("Error!", response.message, response.status);
                                }
                            })
                            .fail(function(){
                                swal('Oops...', '<?php echo e(__('something_went_wrong_with_ajax')); ?>', 'error');
                            })
                    }
                })
        }
    </script>


@endpush





