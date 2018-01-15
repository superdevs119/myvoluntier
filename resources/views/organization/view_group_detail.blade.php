@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        .contents h3{font-weight: 100 !important;}
        .member-table{margin-top: 40px;}
        td img{width: 50px;}
    </style>
@endsection

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight profile-panel">
                    <div class="col-lg-8 profile-info">
                        <div class="profile-image">
                            <div class="profile-image-hover">
                                <img <?php if($group_info['group_logo'] == NULL){ ?>src="<?=asset('img/logo/group-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$group_info['group_logo']}} <?php }?>" class="img-circle circle-border m-b-md" alt="profile">
                            </div>
                        </div>
                        <input id="group_id" type="hidden" value="{{$group_info['group_id']}}">
                        <div class="profile-text">
                            <h1 class="no-margins"><strong>{{$group_info['group_name']}}</strong></h1></br>
                            <div class="inner-content">
                                <h3 class="no-margins">{{$group_info['group_description']}}</h3><br>
                                @if($group_info['is_my_group'] == 0)
                                    <div class="is-joint">
                                        @if($group_info['is_followed'] == 0)
                                            <button class="btn btn-primary" id="btn_follow">Follow</button>
                                            <button class="btn btn-danger" id="btn_unfollow" style="display: none">Unfollow</button>
                                        @else
                                            <button class="btn btn-primary" id="btn_follow" style="display: none">Follow</button>
                                            <button class="btn btn-danger" id="btn_unfollow">Unfollow</button>
                                        @endif
                                        <button class="btn btn-primary btn-member-join"> Join</button>
                                        <button class="btn btn-default btn-member-pending" style="display: none">Pending...</button>
                                    </div>
                                @elseif($group_info['is_my_group'] == 1)
                                    <div class="is-joint">
                                        <button class="btn btn-default btn-member-pending">Pending...</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 profile-view-logo">
                        <div class="header">
                            <h1>Created By</h1>
                        </div>
                        <div class="content">
                            <img <?php if($group_info['org_logo'] == NULL){ ?>src="<?=asset('img/logo/organization-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$group_info['org_logo']}} <?php }?>" class="img-circle circle-border m-b-md" alt="profile">
                            <h3><i class="fa fa-star"></i> <a href="{{url('/profile')}}/{{$group_info['org_id']}}"> {{$group_info['org_name']}} </a> <i class="fa fa-star"></i></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 animated fadeInRight impact-panel">
                    <div class="oppor-details">
                        <div class="tabs-container">
                            <div class="tabs-left">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-details"> Details</a></li>
                                    <li><a data-toggle="tab" href="#tab-members"> Members</a></li>
                                </ul>
                                <div class="tab-content ">
                                    <div id="tab-details" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="detail_header">
                                                <h2><i class="fa fa-ioxhost"></i> Group Details</h2>
                                            </div>
                                            <div class="detail_content col-md-8">
                                                <div class="contents">
                                                    <h3>Created Date: </h3>
                                                    <h3><strong>{{$group_info['group_created_at']}}</strong></h3>
                                                </div>
                                                <div class="contents">
                                                    <h3>Contact Name: </h3>
                                                    <h3><strong>{{$group_info['group_contact_name']}}</strong></h3>
                                                </div>
                                                <div class="contents">
                                                    <h3>Contact Email: </h3>
                                                    <h3><strong>{{$group_info['group_contact_email']}}</strong></h3>
                                                </div>
                                                <div class="contents">
                                                    <h3>Contact Number: </h3>
                                                    <h3><strong>{{$group_info['group_contact_number']}}</strong></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-members" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="detail_header">
                                                <h2><i class="fa fa-users"></i> Group Members</h2>
                                            </div>
                                                <table class="member-table table">
                                                    <thead>
                                                        <tr>
                                                            <th>Member Name</th>
                                                            <th>Role in Group</th>
                                                            <th>Email</th>
                                                            <th>Phone Number</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($member_info as $mi)
                                                        <tr>
                                                            <td style="text-align: left; padding-left: 20px">
                                                                <a href="{{url('/profile')}}/{{$mi['member_id']}}" target="_blank">
                                                                    @if($mi['member_logo'] == null)
                                                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/organization-default-logo.png')?>"> <strong>{{$mi['member_name']}}</strong>
                                                                    @else
                                                                        <img alt="image" class="img-circle" src="<?=asset('uploads')?>/{{$mi['member_logo']}}"> <strong>{{$mi['member_name']}}</strong>
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            @if($mi['user_role'] == 1)
                                                                <td>Administrator</td>
                                                            @else
                                                                <td>Member</td>
                                                            @endif
                                                            <td>{{$mi['member_email']}}</td>
                                                            <td>{{$mi['member_number']}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="8" style="padding :20px 0 0">
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
        $('.member-table').footable();
    });

    $('#btn_follow').on('click',function () {
        var url = API_URL + 'organization/followGroup';
        var group_id = $('#group_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log();
        var type = "POST";
        var formData = {
            group_id: group_id
        }
        $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
                $('#btn_follow').hide();
                $('#btn_unfollow').show();
            },
            error: function (data) {
                $('.login-first').show();
                console.log('Error:', data);
            }
        });
    });

    $('#btn_unfollow').on('click',function () {
        var url = API_URL + 'organization/unfollowGroup';
        var group_id = $('#group_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log();
        var type = "POST";
        var formData = {
            group_id: group_id
        }
        $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
                $('#btn_follow').show();
                $('#btn_unfollow').hide();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.btn-member-join').on('click',function () {
        var url = API_URL + 'organization/jointoGroup';
        var group_id = $('#group_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log();
        var type = "POST";
        var formData = {
            group_id: group_id
        }
        $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
                $('.btn-member-join').hide();
                $('.btn-member-pending').show();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection