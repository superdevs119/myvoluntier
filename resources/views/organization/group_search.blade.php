@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        img{width: 70px;}
        .btn-action-follow{min-width: 85px;}
        .btn-action-unfollow{min-width: 85px;}
        .btn-action-connect{min-width: 85px;}
        .impact-tracked-hours{padding-bottom: 0 !important;}
        .logo-img{float: left}
        .group-content{clear: left; display: inline-block; padding: 10px 0 0 5px;}
    </style>
@endsection

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel" style="margin-top: 0">
                    <div class="impact-tracked-hours">
                        <h2 class="col-md-8"><i class="fa fa-search"></i> Discover Group</h2>
                        <div class="text-center link-block col-md-4">
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="text" id="search_box_page" class="form-control" placeholder="Search Group..." value="{{$keyword}}"> <span class="input-group-btn">
										<button type="button" id="btn_search_page" class="btn btn-primary" style="padding: 6px 12px;"><i class="fa fa-search"></i>
										</button></span>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                    <div class="panel-body">
                        <div class="detail_header">
                            <table class="search-table table table-stripped" data-page-size="10" data-filter=#filter>
                                <tbody>
                                @if(count($groups) == 0)
                                    <tr>
                                        <td>Relevant Group does not exist...</td>
                                    </tr>
                                @else
                                @foreach($groups as $g)
                                    <tr id="group{{$g['group_id']}}">
                                        <td style="text-align: left; padding-left: 50px">
                                            @if($g['group_logo'] == null)
                                                <a href="{{url('/organization/group/view_group_detail')}}/{{$g['group_id']}}" target="_blank">
                                                    <img alt="image" class="img-circle logo-img" src="<?=asset('img/logo/group-default-logo.png')?>">
                                                    <div class="group-content">
                                                        <h3><strong>{{$g['group_name']}}</strong></h3>
                                                        <small>This group has {{$g['members']}} members</small>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                </a>
                                            @else
                                                <a href="{{url('/organization/group/view_group_detail')}}/{{$g['group_id']}}" target="_blank">
                                                    <img alt="image" class="img-circle logo-img" src="<?=asset('uploads')?>/{{$g['group_logo']}}">
                                                    <div class="group-content">
                                                        <h3><strong>{{$g['group_name']}}</strong></h3>
                                                        <small>This group has {{$g['members']}} members</small>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{$g['owner_name']}}</td>
                                        <td></td>
                                        <td style="text-align: right; padding-right: 50px;">
                                            @if($g['is_followed'] == 0)
                                                <a class="btn btn-primary btn-action-follow">Follow</a>
                                                <a class="btn btn-danger btn-action-unfollow" style="display: none">Unfollow</a>
                                            @else
                                                <a class="btn btn-primary btn-action-follow" style="display: none">Follow</a>
                                                <a class="btn btn-danger btn-action-unfollow">Unfollow</a>
                                            @endif
                                            @if($g['status'] == 0)
                                                <a class="btn btn-primary btn-action-join">Ask to Join</a>
                                                <a class="btn btn-default btn-action-join-pending" style="display: none">Pending...</a>
                                            @elseif($g['status'] == 1)
                                                <a class="btn btn-default btn-action-join-pending">Pending...</a>
                                            @endif
                                        </td>
                                        <input class="group-id" type="hidden" value="{{$g['group_id']}}">
                                    </tr>
                                @endforeach
                                @endif
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
                    <div class="divider"></div>
                    <div class="post-footer">
                        <a href="{{url('/organization/group')}}" type="button" id="btn_create_group" class="btn btn-danger pull-right"> Back </a>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('script')
            <script src="<?=asset('js/plugins/footable/footable.all.min.js')?>"></script>
            <script>
                $(document).ready(function() {
                    $('.search-table').footable();
                });
                $('#btn_search_page').on('click',function () {
                    var keyword = $('#search_box_page').val();
                    if(keyword != ''){
                        var url = SITE_URL + 'organization/group/group_search?keyword='+keyword;
                        window.location.replace(url);
                    }
                });

                $('#search_box_page').keyup(function(e){
                    var keyword = $('#search_box_page').val();
                    if(e.keyCode == 13)
                    {
                        if(keyword != ''){
                            var url = SITE_URL + 'organization/group/group_search?keyword='+keyword;
                            window.location.replace(url);
                        }
                    }
                });

                $('.btn-action-follow').on('click',function () {
                    var url = API_URL + 'organization/followGroup';
                    var group_id = $(this).parent().parent().find('.group-id').val();
                    var current_button = $(this);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    console.log();
                    var type = "POST";
                    var formData = {
                        id: group_id
                    }
                    $.ajax({
                        type: type,
                        url: url,
                        data: formData,
                        success: function (data) {
                            current_button.hide();
                            current_button.parent().find('.btn-action-unfollow').show();
                        },
                        error: function (data) {
                            $('.login-first').show();
                            console.log('Error:', data);
                        }
                    });
                });

                $('.btn-action-unfollow').on('click',function () {
                    var url = API_URL + 'organization/unfollowGroup';
                    var group_id = $(this).parent().parent().find('.group-id').val();
                    var current_button = $(this);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    console.log();
                    var type = "POST";
                    var formData = {
                        id: group_id
                    }
                    $.ajax({
                        type: type,
                        url: url,
                        data: formData,
                        success: function (data) {
                            current_button.hide();
                            current_button.parent().find('.btn-action-follow').show();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });

                $('.btn-action-join').on('click',function () {
                    var url = API_URL + 'organization/jointoGroup';
                    var group_id = $(this).parent().parent().find('.group-id').val();
                    var current_button = $(this);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    console.log();
                    var type = "POST";
                    var formData = {
                        id: group_id
                    }
                    $.ajax({
                        type: type,
                        url: url,
                        data: formData,
                        success: function (data) {
                            current_button.hide();
                            current_button.parent().find('.btn-action-join-pending').show();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            </script>
@endsection
