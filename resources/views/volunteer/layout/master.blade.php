<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-quiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=asset('img/logo/logo.png')?>" type="image/x-icon">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=asset('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="<?=asset('css/animate.css')?>" rel="stylesheet">
    <link href="<?=asset('font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=asset('css/style.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
    <link href="<?=asset('css/jquery.tagsinput.css')?>" rel="stylesheet">
    <style>
        .dropdown-search{width: 310px;}
    </style>
    @yield('css')
</head>
<body class="fixed-sidebar no-skin-config full-height-layout fixed-nav">

<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="page-scroll" href="{{url('/')}}">
                <img alt="image" class="top-logo" src="<?=asset('img/logo/mvlogo.png')?>">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav nav-menu">
                <li @if($page_name == 'vol_home') class="active" @endif><a class="page-scroll" href="{{url('volunteer/')}}"><i class="fa fa-home"></i>Home</a></li>
                <!--<li <?php if($page_name == 'vol_profile'){ ?>class="active" <?php } ?>><a class="page-scroll" href="{{url('volunteer/profile')}}"><i class="fa fa-user"></i>Profile</a></li> -->
                <li <?php if($page_name == 'vol_oppor'){ ?>class="active" <?php } ?>><a class="page-scroll" href="{{url('volunteer/opportunity')}}"><i class="fa fa-globe"></i>Opportunities</a></li>
                <li <?php if($page_name == 'vol_track'){ ?>class="active" <?php } ?>><a class="page-scroll" href="{{url('volunteer/track')}}"><i class="fa fa-line-chart"></i>Track</a></li>
                <li <?php if($page_name == 'vol_friend'){ ?>class="active" <?php } ?>><a class="page-scroll" href="{{url('volunteer/friend')}}"><i class="fa fa-user-plus"></i>Friends</a></li>
                <li <?php if($page_name == 'vol_group'){ ?>class="active" <?php } ?>><a class="page-scroll" href="{{url('volunteer/group')}}"><i class="fa fa-group"></i>Groups</a></li>
                <li <?php if($page_name == 'vol_impact'){ ?>class="active" <?php } ?>><a class="page-scroll" href="{{url('volunteer/impact')}}"><i class="fa fa-pie-chart"></i>Impact</a></li>
            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" data-placement="bottom" title="Search User/Org" href="#">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search">
                        <li>
                            <div class="text-center link-block">
                                <div class="search-box">
                                    <div class="input-group">
                                        <input type="text" id="search_box" class="form-control" placeholder="Search..."> <span class="input-group-btn">
										<button type="button" id="btn_search" class="btn btn-primary" style="padding: 6px 12px;"><i class="fa fa-search"></i>
										</button></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" title="Add Hours" href="{{url('volunteer/single_track')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info show_show_dlg" href="#" data-toggle="modal" data-target="#share_profile" title="Share Profile">
                        <i class="fa fa-slideshare"></i>
                    </a>
                    <div class="modal inmodal" id="share_profile" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated flipInY">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Share Your Profile</h4>
                                    <h3>You can share your profile via email!</h3>
                                </div>
                                <div class="spiner-view" style="padding: 70px 0">
                                    <div class="sk-spinner sk-spinner-wave">
                                        <div class="sk-rect1"></div>
                                        <div class="sk-rect2"></div>
                                        <div class="sk-rect3"></div>
                                        <div class="sk-rect4"></div>
                                        <div class="sk-rect5"></div>
                                    </div>
                                </div>
                                <div class="modal-body login-first">
                                    <div class="col-md-12 reg-content">
                                        <p><strong>Emails: </strong></p>
                                        <input type="text" name="share_emails" id="share_emails" class="form-control" placeholder="Enter Email Addresses to Share Your Profile"  autocomplete="off"/>
                                        <p class="p_invalid" id="invalid_email_alert" style="display: none">Invalid Email Address</p>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="col-md-12 reg-content">
                                        <p><strong>Comments: </strong></p>
                                        <textarea class="form-control" name="comments" id="comments" rows="6" placeholder="You can enter Comments Here"></textarea>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <div class="modal-body success-first">
                                    <div class="col-md-12 reg-content" style="text-align: center">
                                        <h3>You shared your profile successfully!</h3>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="modal-footer">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_close">Close</button>
                                        <button type="submit" id="btn_share" class="btn btn-primary">Share</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" data-placement="bottom" title="Messages Box" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning" style="display: none">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" title="Alerts" href="{{url('/viewAlert')}}">
                        <i class="fa fa-bell"></i>  <span class="label label-primary label-alert" style="display: none">8</span>
                    </a>
                </li>
                <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" data-placement="bottom" title="Account Setting" href="#">
                        <i class="fa fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <div class="dropdown-user-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" <?php if(Auth::user()->logo_img == NULL){ ?>src="<?=asset('img/logo/member-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{Auth::user()->logo_img}}" <?php }?>>
                                </a>
                                <div class="user-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
                                <div class="user-email">{{Auth::user()->email}}</div>
                                <div class="profile-button">
                                    <a href="{{url('volunteer/profile')}}" class="btn btn-primary">
                                        <i class="fa fa-user"></i> My Profile
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="{{url('signout_user')}}">
                                    <i class="fa fa-sign-out"></i> <strong>Sign out</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>

@yield('content')

<div class="footer">
    <div class="pull-right">
    </div>
    <div class="copy-right">
    </div>
</div>
</div>

<!-- Mainly scripts -->
<script src="<?=asset('js/jquery-2.1.1.js')?>"></script>
<script src="<?=asset('js/bootstrap.min.js')?>"></script>
<script src="<?=asset('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
<script src="<?=asset('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
<script src="<?=asset('js/plugins/chosen/chosen.jquery.js')?>"></script>
<script src="<?=asset('js/plugins/cropper/cropper.min.js')?>"></script>
<!-- Custom and plugin javascript -->
<script src="<?=asset('js/inspinia.js')?>"></script>
<script src="<?=asset('js/plugins/pace/pace.min.js')?>"></script>
<script src="<?=asset('js/highstock.js')?>"></script>
<script src="<?=asset('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
<script src="<?=asset('js/global.js')?>"></script>
<script src="<?=asset('js/check_validate.js')?>"></script>
<script src="<?=asset('js/jquery.tagsinput.js')?>"></script>
<script>
    $(document).ready(function () {
        var d = new Date();
        var n = d.getFullYear();
        $('.copy-right').html('<strong>MyVoluntier, LLC &copy;'+ n+'.</strong> All Rights Reserved');

        $('.show_show_dlg').on('click',function () {
            $(".spiner-view").hide();
            $('.success-first').hide();
            $('.login-first').show();
            $('#btn_share').show();
            $('.tagsinput .tag').remove();
            $('#share_emails').val('');
            $('#comments').val('');
        })

        $(".spiner-view").hide();
        $('.success-first').hide();
        $(document).ajaxStart(function () {
            $(".spiner-view").show();
            $('.login-first').hide();
        }).ajaxStop(function () {
            $(".spiner-view").hide();
        });

        getMessages();
        getAlert();
    });

    function getMessages() {
        var url = API_URL + 'getMessages';
        var user_id = $('#user_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log();
        var type = "post";
        var formData = {
            user_id: user_id,
        };
        $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
                if(data.result.length > 0){
                    $('.label-warning').show();
                    $('.label-warning').html(data.result.length);
                    $.each(data.result, function (index,value) {
                        var logo = SITE_URL+'uploads/'+value.sender_logo;
                        if(value.sender_logo == null){
                            if(value.sender_role == 'volunteer'){
                                logo = SITE_URL+'img/logo/member-default-logo.png';
                            }else{
                                logo = SITE_URL+'img/logo/organization-default-logo.png';
                            }
                        }
                        var content = value.content;
                        if(content.length > 25){
                            content = content.slice(0,25)+'...';
                        }
                        $('.dropdown-messages').append($('<li><div class="dropdown-messages-box"><a href="#" class="pull-left"><img alt="image" class="img-circle" src="'+logo+'"></a><a style="padding: 0"><div class="media-body"><strong>'+value.sender_name+'</strong><br> '+content+' <br><small class="text-muted">'+value.created_at+'</small></div></a></div></li><li class="divider"></li>'));
                    });
                    $('.dropdown-messages').append($('<li><div class="text-center link-block"><a href="mailbox.html"><i class="fa fa-envelope"></i> <strong>Read All Messages</strong> <i class="fa fa-angle-right"></i></a></div></li>'));
                }
                else{
                    $('.label-warning').hide();
                    $('.dropdown-messages').append($('<li><div class="text-center link-block"><a href="mailbox.html"><i class="fa fa-envelope"></i> <strong>Read All Messages</strong> <i class="fa fa-angle-right"></i></a></div></li>'));
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function getAlert(){
        var url = API_URL + 'getAlert';
        var user_id = $('#user_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log();
        var type = "post";
        var formData = {
            user_id: user_id,
        };
        $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
                if(data.result > 0){
                    $('.label-alert').show();
                    $('.label-alert').html(data.result);
                }
                else{
                    $('.label-alert').hide();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function onAddTag(tag) {
        alert("Added a email addresses: " + tag);
    }
    function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
    }

    function onChangeTag(input,tag) {
        alert("Changed a tag: " + tag);
    }

    $(function() {
        $('#share_emails').tagsInput({width: 'auto'});
    });

    $('#btn_share').on('click',function () {
        var url = API_URL + 'share_profile';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        console.log();
        var type = "POST";
        var formData = {
            emails: $("#share_emails").val(),
            comments: $('#comments').val(),
        }
        $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
                $('.success-first').show();
                $('#btn_share').hide();
            },
            error: function (data) {
                $('.login-first').show();
                console.log('Error:', data);
            }
        });
    })

    $('#btn_search').on('click',function () {
        var keyword = $('#search_box').val();
        if(keyword != ''){
            var url = SITE_URL + 'volunteer/search?keyword='+keyword;
            window.location.replace(url);
        }
    });

    $('#search_box').keyup(function(e){
        var keyword = $('#search_box').val();
        if(e.keyCode == 13)
        {
            if(keyword != ''){
                var url = SITE_URL + 'volunteer/search?keyword='+keyword;
                window.location.replace(url);
            }
        }
    });
</script>
@yield('script')
</body>
</html>
