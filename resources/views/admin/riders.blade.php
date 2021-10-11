@extends('layouts.app_admin')

@section('content')
<div class="card card-cascade narrower">
    <div class="table-responsive"> 
        <table class="table">
            <thead class="blue-grey lighten-4">
                <tr>
                    <th>#</th>
                    <th>{{__('admin_pages.user_name')}}</th>
                    <th>{{__('admin_pages.user_email')}}</th>
                    <th>{{__('admin_pages.user_phone')}}</th>
                    <th>{{__('admin_pages.user_created_at')}}</th>
                    <th>{{__('admin_pages.rider_no')}}</th>
                    <th class="text-right">
                        <button class="btn btn-sm btn-secondary waves-effect waves-light" data-toggle="modal" data-target="#modalAddEditRiders">
                            {{__('admin_pages.add_user')}}
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riders as $rider) 
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$rider->name}}</td>
                    <td>{{$rider->email}}</td>
                    <td>{{$rider->phone}}</td>
                    <td>{{$rider->created_at}}</td>
                    <td>{{$rider->riderNo}}</td>
                    <td class="text-right">
                        <a href="?edit={{$rider->id}}" class="btn btn-sm btn-secondary waves-effect waves-light">{{__('admin_pages.edit_user')}}</a>
                        <a href="{{lang_url('admin/delete/riders/'.$rider->id)}}" class="btn btn-sm btn-secondary waves-effect waves-light confirm" data-my-message="{{__('admin_pages.are_u_sure_delete_u')}}">{{__('admin_pages.delete_user')}}</a>
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>  
</div>
{{ $riders->links() }}
<!-- Modal Add/Edit riders -->
<div class="modal fade" id="modalAddEditRiders" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{__('admin_pages.rider_settings')}}</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="formManageUsers">
                    {{ csrf_field() }} 
                    <input type="hidden" name="edit" value="{{isset($_GET['edit']) ? $_GET['edit'] : 0 }}"> 
                    <div class="md-form">
                        <i class="fa fa-user prefix grey-text"></i>
                        <input type="text" name="name" value="{{$riderInfo != null? $riderInfo->name : ''}}" id="defaultForm-name" class="form-control">
                        <label for="defaultForm-name">{{__('admin_pages.user_name')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="text" name="email" value="{{$riderInfo != null? $riderInfo->email : ''}}" id="defaultForm-email" class="form-control">
                        <label for="defaultForm-email">{{__('admin_pages.user_email')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-phone prefix grey-text"></i>
                        <input type="number" name="phone" value="{{$riderInfo != null? $riderInfo->phone : ''}}" id="defaultForm-digits" class="form-control">
                        <label for="defaultForm-digits">{{__('admin_pages.user_phone')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" name="password" id="defaultForm-pass" class="form-control">
                        <label for="defaultForm-pass">{{__('admin_pages.user_password')}}</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin_pages.close')}}</button>
                <button type="button" class="btn btn-secondary" onclick="updateUser()">{{__('admin_pages.save_changes')}}</button>
            </div>
        </div>
    </div>
</div>
<script>
    @php
            if (isset($_GET['edit']))
    {
    @endphp
            $(document).ready(function(){
    $('#modalAddEditRiders').modal('show');
    });
            $("#modalAddEditRiders").on("hidden.bs.modal", function () {
    window.location.href = "{{ lang_url('admin/riders') }}";
    });
            @php
    }
    @endphp
</script>
@endsection
