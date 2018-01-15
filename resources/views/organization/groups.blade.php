@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        img{width: 70px;}
    </style>
@endsection

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel" style="margin-top: 0">
                    <div class="impact-tracked-hours">
                        <a href="{{url('organization/group/group_add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create Group</a>
                        <a href="{{url('organization/group/group_search')}}" class="btn btn-primary"><i class="fa fa-search"></i> Discover Group</a>
                    </div>
                    <div class="divider"></div>

                    <div class="panel-body">
                        <div class="detail_header">
                            <h2><i class="fa fa-group"></i> My Groups</h2>
                            <table class="group-table table table-stripped" data-page-size="10" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th>Group Name</th>
                                    <th>Your Role</th>
                                    <th>Member counts</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($info as $i)
                                    <tr>
                                        <td style="text-align: left; padding-left: 50px">
                                            @if($i['group_logo'] == null)
                                                <a href="{{url('/')}}/organization/group/view_group_detail/{{$i['group_id']}}" target="_blank">
                                                    <img alt="image" class="img-circle" src="<?=asset('img/logo/group-default-logo.png')?>"> <strong>{{$i['group_name']}}</strong>
                                                </a>
                                            @else
                                                <a href="{{url('/')}}/organization/group/view_group_detail/{{$i['group_id']}}" target="_blank">
                                                    <img alt="image" class="img-circle" src="<?=asset('uploads')?>/{{$i['group_logo']}}"> <strong>{{$i['group_name']}}</strong>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{$i['group_role']}}</td>
                                        <td>{{$i['group_member']}}</td>
                                        <td style="text-align: right; padding-right: 50px">
                                            @if($i['group_role'] == "Administrator")
                                                <a class="btn btn-primary">Invite</a>
                                                <a class="btn btn-primary">Message</a>
                                                <a href="{{url('/organization/group/group_add')}}/{{$i['group_id']}}" class="btn btn-primary">Edit</a>
                                                <a class="btn btn-danger">Remove</a>
                                            @else
                                                <a class="btn btn-primary">Invite</a>
                                                <a class="btn btn-primary">Message</a>
                                                <a class="btn btn-danger">Remove</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4" style="padding :20px 0 0">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script src="<?=asset('js/plugins/footable/footable.all.min.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('.group-table').footable();
        });
    </script>
@endsection
