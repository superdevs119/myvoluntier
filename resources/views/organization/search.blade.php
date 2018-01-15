@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        img{width: 70px;}
        .btn-action-follow{min-width: 85px;}
        .btn-action-unfollow{min-width: 85px;}
        .btn-action-connect{min-width: 85px;}
        .impact-tracked-hours{padding-bottom: 0 !important;}
    </style>
@endsection

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel" style="margin-top: 0">
                    <div class="impact-tracked-hours">
                        <h2 class="col-md-8"><i class="fa fa-search"></i> Search Result</h2>
                        <div class="text-center link-block col-md-4">
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="text" id="search_box_page" class="form-control" placeholder="Search Organization..." value="{{$keyword}}"> <span class="input-group-btn">
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
                                @if(count($result)<1)
                                    <tr>
                                        <td>Search result does not exist...</td>
                                    </tr>
                                @else
                                    @foreach($result as $r)
                                        <tr id="tr{{$r['id']}}">
                                            <td style="text-align: left; padding-left: 50px">
                                                @if($r['logo_img'] == null)
                                                    @if($r['user_role'] == 'organization')
                                                        <a href="{{url('/')}}/organization/profile/{{$r['id']}}" target="_blank">
                                                            <img alt="image" class="img-circle" src="<?=asset('img/logo/organization-default-logo.png')?>"> <strong>{{$r['name']}}</strong>
                                                        </a>
                                                    @elseif($r['user_role'] == 'volunteer')
                                                        <a href="{{url('/')}}/organization/profile/{{$r['id']}}" target="_blank">
                                                            <img alt="image" class="img-circle" src="<?=asset('img/logo/member-default-logo.png')?>"> <strong>{{$r['name']}}</strong>
                                                        </a>
                                                    @elseif($r['user_role'] == 'group')
                                                        <a href="{{url('/')}}/organization/group/view_group_detail/{{$r['id']}}" target="_blank">
                                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/group-default-logo.png')?>"> <strong>{{$r['name']}}</strong>
                                                        </a>
                                                    @endif
                                                @else
                                                    @if($r['user_role'] == 'group')
                                                        <a href="{{url('/')}}/organization/group/view_group_detail/{{$r['id']}}" target="_blank">
                                                            <img alt="image" class="img-circle" src="<?=asset('uploads')?>/{{$r['logo_img']}}"> <strong>{{$r['name']}}</strong>
                                                        </a>
                                                    @else
                                                        <a href="{{url('/')}}/organization/profile/{{$r['id']}}" target="_blank">
                                                            <img alt="image" class="img-circle" src="<?=asset('uploads')?>/{{$r['logo_img']}}"> <strong>{{$r['name']}}</strong>
                                                        </a>
                                                    @endif

                                                @endif
                                            </td>
                                            <td>{{$r['user_role']}}</td>
                                            <td>@if($r['user_role'] != 'group')
                                                    {{$r['city']}}, {{$r['state']}}, {{$r['country']}}
                                                @endif
                                            </td>
                                            <td style="text-align: right; padding-right: 50px;">
                                                @if($r['user_role'] == 'organization')
                                                    @if($r['is_followed'] == 0)
                                                        <a class="btn btn-primary btn-action-follow">Follow</a>
                                                        <a class="btn btn-danger btn-action-unfollow" style="display: none">Unfollow</a>
                                                    @else
                                                        <a class="btn btn-primary btn-action-follow" style="display: none">Follow</a>
                                                        <a class="btn btn-danger btn-action-unfollow">Unfollow</a>
                                                    @endif
                                                    @if($r['is_friend'] == 0)
                                                        <a class="btn btn-primary btn-action-connect">Connect</a>
                                                        <a class="btn btn-default btn-action-connect-pending" style="display: none">Pending..</a>
                                                    @elseif($r['is_friend'] == 1)
                                                        <a class="btn btn-default btn-action-connect-pending">Pending..</a>
                                                    @endif
                                                @elseif($r['user_role'] == 'volunteer')
                                                    @if($r['is_friend'] == 0)
                                                        <a class="btn btn-primary btn-action-connect">Connect</a>
                                                        <a class="btn btn-default btn-action-connect-pending" style="display: none">Pending..</a>
                                                    @elseif($r['is_friend'] == 1)
                                                        <a class="btn btn-default btn-action-connect-pending">Pending..</a>
                                                    @endif
                                                @elseif($r['user_role'] == 'group')
                                                    @if($r['is_followed'] == 0)
                                                        <a class="btn btn-primary btn-action-follow">Follow</a>
                                                        <a class="btn btn-danger btn-action-unfollow" style="display: none">Unfollow</a>
                                                    @else
                                                        <a class="btn btn-primary btn-action-follow" style="display: none">Follow</a>
                                                        <a class="btn btn-danger btn-action-unfollow">Unfollow</a>
                                                    @endif
                                                    @if($r['is_friend'] == 0)
                                                        <a class="btn btn-primary btn-action-connect">Connect</a>
                                                        <a class="btn btn-default btn-action-connect-pending" style="display: none">Pending..</a>
                                                    @elseif($r['is_friend'] == 1)
                                                        <a class="btn btn-default btn-action-connect-pending">Pending..</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <input class="current-type" type="hidden" value="{{$r['user_role']}}">
                                            <input class="current-id" type="hidden" value="{{$r['id']}}">
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
                var url = SITE_URL + 'organization/search?keyword='+keyword;
                window.location.replace(url);
            }
        });

        $('#search_box_page').keyup(function(e){
            var keyword = $('#search_box_page').val();
            if(e.keyCode == 13)
            {
                if(keyword != ''){
                    var url = SITE_URL + 'organization/search?keyword='+keyword;
                    window.location.replace(url);
                }
            }
        });
        
        $('.btn-action-follow').on('click',function () {
            var user_type = $(this).parent().parent().find('.current-type').val();
            if(user_type == 'group'){
                var url = API_URL + 'organization/followGroup';
            }else{
                var url = API_URL + 'organization/followOrganization';
            }
            var id = $(this).parent().parent().find('.current-id').val();
            var current_button = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log();
            var type = "POST";
            var formData = {
                id: id
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
            var user_type = $(this).parent().parent().find('.current-type').val();
            if(user_type == 'group'){
                var url = API_URL + 'organization/unfollowGroup';
            }else{
                var url = API_URL + 'organization/unfollowOrganization';
            }
            var id = $(this).parent().parent().find('.current-id').val();
            var current_button = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log();
            var type = "POST";
            var formData = {
                id: id
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

        $('.btn-action-connect').on('click',function () {
            var user_type = $(this).parent().parent().find('.current-type').val();
            if(user_type == 'group'){
                var url = API_URL + 'organization/jointoGroup';
            }else{
                var url = API_URL + 'organization/connectOrganization';
            }
            var id = $(this).parent().parent().find('.current-id').val();
            var current_button = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log();
            var type = "POST";
            var formData = {
                id: id
            }
            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    current_button.hide();
                    current_button.parent().find('.btn-action-connect-pending').show();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection
