<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-quiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=asset('img/logo/mvlogo.png')?>" type="image/x-icon">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=asset('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="<?=asset('css/animate.css')?>" rel="stylesheet">
    <link href="<?=asset('font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=asset('css/style.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        .td-content{float: left; padding-left: 10px;}
    </style>
<body>
@if($user_role == 'organization')
    <div class="content-panel">
        <div class="profile-back-image">
            <img alt="image" <?php if($user_info->back_img == NULL){ ?>src="<?=asset('img/gallery/12.jpg') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$user_info->back_img}}" <?php }?> style="margin: 0;">
            <div class="org-info-logo">
                <img alt="image" <?php if($user_info->logo_img == NULL){ ?>src="<?=asset('img/logo/organization-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$user_info->logo_img}}" <?php }?>>
            </div>
            <div class="org-info-bar">
                <div class="info-bar-contents">
                    <div class="content-bar">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <h2>{{count($members)}}</h2>
                            <p>Members</p>
                        </div>
                        <div class="col-md-3">
                            <h2>{{$group->count()}}</h2>
                            <p>Groups</p>
                        </div>
                        <div class="col-md-3">
                            <h2>{{$active_oppr->count()}}</h2>
                            <p>Active Opportunities</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content wrapper-org-profile">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight profile-panel">
                    <div class="col-lg-8 profile-info">
                        <div class="org-profile">
                            <h1 class="no-margins"><strong>{{$user_info->org_name}}</strong></h1>
                            <div class="inner-content">
                                <h2 class="no-margins">{{$user_info->type_name}}</h2></br>
                                <p>{{$user_info->brif}}<p>
                                    <div class="is-joint" style="display: none">
                                        <button class="btn btn-primary"><i class="fa fa-chain"></i> Join</button>
                                        <a type="button" class="btn btn-primary page-scroll" href="#" data-toggle="modal" data-target="#invite_mem"><i class="fa fa-slideshare"></i> Invite Members</a>
                                        <div class="modal inmodal" id="invite_mem" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated flipInY">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h4 class="modal-title"><i class="fa fa-slideshare"></i> Invite Friends to Join!</h4>
                                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                                                        <h2>General Haak opportunity</h2>
                                                        <h3>Volunteer Service</h3>
                                                        <small class="font-bold">Creted by Jackson Tims</small>
                                                    </div>
                                                    <div class="modal-body login-first">
                                                        <div class="col-md-12 reg-content">
                                <p><strong>Email: </strong></p>
                                <input type="text" id="login_email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-md-12 reg-content">
                                <p><strong>Comments: </strong></p>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary">Invite</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p>You are a member. </p>
            <div class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Change<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Member</a></li>
                    <li><a href="#">Contributor</a></li>
                    <li><a href="#">Moderator</a></li>
                    <li><a href="#">Administrator</a></li>
                    <li><a href="#">Leave</a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="col-lg-4 profile-view-logo">
        <div class="header">
            <h1><i class="fa fa-pie-chart"></i> Impacts</h1>
        </div>
        <div class="content">
            <h1>{{$tracks_hours}}</h1>
            <h3>HOURS</h3>
        </div>
    </div>
    </div>

    <div class="col-lg-12 animated fadeInRight impact-panel">
        <div class="oppor-details">
            <div class="tabs-container">
                <div class="tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-details"> Details</a></li>
                        <li><a data-toggle="tab" href="#tab-opportunities"> Opportunities</a></li>
                        {{--<li><a data-toggle="tab" href="#tab-events"> Events</a></li>--}}
                        <li><a data-toggle="tab" href="#tab-groups"> Groups</a></li>
                        <li><a data-toggle="tab" href="#tab-members"> Members</a></li>
                        {{--<li><a data-toggle="tab" href="#tab-contact"> Contact</a></li>--}}
                    </ul>
                    <div class="tab-content ">
                        <div id="tab-details" class="tab-pane active">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-ioxhost"></i> Organization Details</h2>
                                </div>
                                <div class="detail_content">
                                    <div class="col-md-7">
                                        <div class="contents">
                                            <h3>Organization ID:</h3>
                                            <p>{{$user_info->user_name}}</p>
                                        </div>
                                        <div class="contents">
                                            <h3>Organization Name:</h3>
                                            <p>{{$user_info->org_name}}</p>
                                        </div>
                                        <div class="contents">
                                            <h3>Contact Email:</h3>
                                            <p>{{$user_info->email}}</p>
                                        </div>
                                        <div class="contents">
                                            <h3>Phone number:</h3>
                                            <p>{{$user_info->contact_number}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 g-map">
                                        <div id="pos_map" style="height: 240px;">
                                            <input type="hidden" id="lat_val" value="{{$user_info->lat}}">
                                            <input type="hidden" id="lng_val" value="{{$user_info->lng}}">
                                        </div>
                                        <div class="contents">
                                            <h3>Address:</h3>
                                            <p>{{$user_info->city}}, {{$user_info->state}}, {{$user_info->country}} {{$user_info->zipcode}}</p>
                                        </div>
                                        @if($user_info->website)
                                            <div class="contents">
                                                <h3>Website:</h3>
                                                <p><a href="" style="color: #eee;">{{$user_info->website}}</a></p>
                                            </div>
                                        @endif
                                        <div class="contents">
                                            <h3>Organization Type:</h3>
                                            <p>{{$user_info->type_name}}</p>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-opportunities" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-building-o"></i> Organization Opportunities</h2>
                                </div>
                                <div class="detail_content">
                                    <table class="table_activity table table-stripped">
                                        <tbody>
                                        @foreach($active_oppr as $opp)
                                            <tr>
                                                <td style="text-align: left; padding-left: 50px">
                                                    @if($opp->logo_img == null)
                                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>" style="width: 120px; height: 120px; float: left">
                                                    @else
                                                        <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$opp->logo_img}}"  style="width: 120px; height: 120px; float: left">
                                                    @endif
                                                    <div class="td-content">
                                                        <a href="{{url('/volunteer/view_opportunity')}}/{{$opp->id}}"><h2>{{$opp->title}}</h2></a>
                                                        <h3>{{$opp->opportunity_type}}</h3>
                                                        <p>{{$opp->description}}</p>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-groups" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-building-o"></i> My Groups</h2>
                                </div>
                                <div class="detail_content">
                                    <table class="table_activity table table-stripped">
                                        <tbody>
                                        @foreach($group as $g)
                                            <tr>
                                                <td style="text-align: left; padding-left: 50px">
                                                    @if($g->logo_img == null)
                                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/group-default-logo.png')?>" style="width: 120px; height: 120px; float: left">
                                                    @else
                                                        <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$g->logo_img}}" style="width: 120px; height: 120px; float: left;">
                                                    @endif
                                                    <div class="td-content">
                                                        <a href=""><h2>{{$g->name}}</h2></a>
                                                        @if($g->role_id == 1)
                                                            <h3>Administrator</h3>
                                                        @else
                                                            <h3>Member</h3>
                                                        @endif
                                                        <p>{{$g->description}}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-events" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-calendar"></i> Organization Events</h2>
                                </div>
                                <div class="detail_content">
                                    <div class="org-oppor-detail">
                                        <div class="img-logo">
                                            <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                                        </div>
                                        <div class="detail-text">
                                            <a href=""><h2>Skymedia Garden</h2></a>
                                            <h3>Opportunity</h3>
                                            <p>He is very good and talent man. He helped us with his excellent ability. Thanks.</p>
                                        </div>
                                    </div>
                                    <div class="org-oppor-detail">
                                        <div class="img-logo">
                                            <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                                        </div>
                                        <div class="detail-text">
                                            <a href=""><h2>Skymedia Garden</h2></a>
                                            <h3>Opportunity</h3>
                                            <p>He is very good and talent man. He helped us with his excellent ability. Thanks.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-news" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-newspaper-o"></i> Organization News</h2>
                                </div>
                                <div class="detail_content">
                                    <div class="org-oppor-detail">
                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                                        <div class="detail-text">
                                            <a href=""><h2>Skymedia Garden</h2></a>
                                            <h3>Opportunity</h3>
                                            <p>He is very good and talent man. He helped us with his excellent ability. Thanks.</p>
                                        </div>
                                    </div>
                                    <div class="org-oppor-detail">
                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                                        <div class="detail-text">
                                            <a href=""><h2>Skymedia Garden</h2></a>
                                            <h3>Opportunity</h3>
                                            <p>He is very good and talent man. He helped us with his excellent ability. Thanks.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-members" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-users"></i> Organization Members</h2>
                                </div>
                                <div class="detail_content">
                                    <h3>Members of this Organization</h3>
                                    <table class="member-table table table-stripped" data-page-size="10">
                                        <thead>
                                        <tr>
                                            <th>Member Name</th>
                                            <th>Gender</th>
                                            <th>Zipcode</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($members as $f)
                                            <tr>
                                                <td style="text-align: left; padding-left: 50px;">
                                                    @if($f->logo_img == null)
                                                        <img src="{{url('/img/logo/member-default-logo.png')}}" class="img-circle" style="width: 60px">
                                                    @else
                                                        <img src="{{url('/uploads')}}/{{$f->logo_img}}" class="img-circle" style="width: 60px">
                                                    @endif
                                                    <a href="{{url('/profile')}}/{{$f->id}}"><strong>{{$f->first_name}} {{$f->last_name}}</strong></a>
                                                </td>
                                                <td>{{$f->gender}}</td>
                                                <td>{{$f->zipcode}}</td>
                                                <td>{{$f->email}}</td>
                                                <td>{{$f->contact_number}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="7" style="padding :20px 0 0">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="tab-contact" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-info-circle"></i> Organization Contact</h2>
                                </div>
                                <div class="detail_content">
                                    <p>To send a message to this organization,please fill out blow forms and click send.</p></br>
                                    <strong><h3>Subject</h3></strong>
                                    <input type="text" class="form-control">
                                    <strong><h3>Message</h3></strong>
                                    <textarea rows="10" class="form-control"></textarea>
                                    <button class="btn btn-primary pull-right" style="margin-top: 15px; min-width: 120px;"> Send </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="footer">
        <div class="pull-right">
        </div>
        <div class="copy-right">
            <strong>My Voluntier &copy; 2018.</strong> All Rights Reserved
        </div>
    </div>
    </div>
@else
    <div class="content-panel">
        <div class="profile-back-image">
            <img alt="image" <?php if($user_info->back_img == NULL){ ?>src="<?=asset('img/gallery/12.jpg') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$user_info->back_img}}" <?php }?> style="margin: 0;">
            <div class="org-info-logo">
                <img alt="image" <?php if($user_info->logo_img == NULL){ ?>src="<?=asset('img/logo/member-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$user_info->logo_img}}" <?php }?>>
            </div>
            <div class="org-info-bar">
                <div class="info-bar-contents">
                    <div class="content-bar">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <h2>{{$friend->count()}}</h2>
                            <p>Friends</p>
                        </div>
                        <div class="col-md-3">
                            <h2>{{$group->count()}}</h2>
                            <p>Groups</p>
                        </div>
                        <div class="col-md-3">
                            <h2>{{$opportunity->count()}}</h2>
                            <p>Opportunities</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content wrapper-org-profile">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight profile-panel">
                    <div class="col-lg-8 profile-info">
                        <div class="org-profile">
                            <h1 class="no-margins"><strong>{{$user_info->first_name}} {{$user_info->last_name}}</strong></h1>
                            <div class="inner-content">
                                <h2 class="no-margins">My Summary</h2></br>
                                <p>{{$user_info->brif}}<p>
                                    <div class="is-joint" style="display: none">
                                        <button class="btn btn-primary"><i class="fa fa-chain"></i> Join</button>
                                        <a type="button" class="btn btn-primary page-scroll" href="#" data-toggle="modal" data-target="#invite_mem"><i class="fa fa-slideshare"></i> Invite Members</a>
                                        <div class="modal inmodal" id="invite_mem" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated flipInY">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h4 class="modal-title"><i class="fa fa-slideshare"></i> Invite Friends to Join!</h4>
                                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                                                        <h2>General Haak opportunity</h2>
                                                        <h3>Volunteer Service</h3>
                                                        <small class="font-bold">Creted by Jackson Tims</small>
                                                    </div>
                                                    <div class="modal-body login-first">
                                                        <div class="col-md-12 reg-content">
                                <p><strong>Email: </strong></p>
                                <input type="text" id="login_email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-md-12 reg-content">
                                <p><strong>Comments: </strong></p>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary">Invite</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p>You are a member. </p>
            <div class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Change<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Member</a></li>
                    <li><a href="#">Contributor</a></li>
                    <li><a href="#">Moderator</a></li>
                    <li><a href="#">Administrator</a></li>
                    <li><a href="#">Leave</a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="col-lg-4 profile-view-logo">
        <div class="header">
            <h1><i class="fa fa-pie-chart"></i> Impacts</h1>
        </div>
        <div class="content">
            <h1>{{$logged_hours}}</h1>
            <h3>HOURS</h3>
        </div>
    </div>
    </div>

    <div class="col-lg-12 animated fadeInRight impact-panel">
        <div class="oppor-details">
            <div class="tabs-container">
                <div class="tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-details">Info </a></li>
                        <li><a data-toggle="tab" href="#tab-opportunities"> Opportunities</a></li>
                        {{--<li><a data-toggle="tab" href="#tab-events"> Events</a></li>--}}
                        <li><a data-toggle="tab" href="#tab-groups"> Groups</a></li>
                        <li><a data-toggle="tab" href="#tab-members"> Friends</a></li>
                        {{--<li><a data-toggle="tab" href="#tab-contact"> Contact</a></li>--}}
                    </ul>
                    <div class="tab-content ">
                        <div id="tab-details" class="tab-pane active">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-ioxhost"></i>Personal Info</h2>
                                </div>
                                <div class="detail_content">
                                    <div class="col-md-7">
                                        <div class="contents">
                                            <h3>User ID:</h3>
                                            <p>{{$user_info->user_name}}</p>
                                        </div>
                                        <div class="contents">
                                            <h3>Contact Email:</h3>
                                            <p>{{$user_info->email}}</p>
                                        </div>
                                        <div class="contents">
                                            <h3>Phone number:</h3>
                                            <p>{{$user_info->contact_number}}</p>
                                        </div>
                                        <div class="contents">
                                            <h3>Birthdate:</h3>
                                            <p>{{$user_info->birth_date}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 g-map">
                                        <div id="pos_map" style="height: 240px;">
                                            <input type="hidden" id="lat_val" value="{{$user_info->lat}}">
                                            <input type="hidden" id="lng_val" value="{{$user_info->lng}}">
                                        </div>
                                        <div class="contents">
                                            <h3>Location:</h3>
                                            <p>{{$user_info->city}}, {{$user_info->state}},{{$user_info->country}} {{$user_info->zipcode}}</p>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-opportunities" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-building-o"></i> Joined Opportunities</h2>
                                </div>
                                <div class="detail_content">
                                    <table class="table_activity table table-stripped">
                                        <tbody>
                                        @foreach($opportunity as $opp)
                                            <tr>
                                                <td style="text-align: left; padding-left: 50px">
                                                    @if($opp->logo_img == null)
                                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>" style="width: 120px; float: left">
                                                    @else
                                                        <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$opp->logo_img}}"  style="width: 120px; height: 120px; float: left">
                                                    @endif
                                                    <div class="td-content">
                                                        <a href="{{url('/volunteer/view_opportunity')}}/{{$opp->id}}"><h2>{{$opp->title}}</h2></a>
                                                        <h3>{{$opp->opportunity_type}}</h3>
                                                        <p>{{$opp->description}}</p>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-groups" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-building-o"></i> My Groups</h2>
                                </div>
                                <div class="detail_content">
                                    <table class="table_activity table table-stripped">
                                        <tbody>
                                        @foreach($group as $g)
                                            <tr>
                                                <td style="text-align: left; padding-left: 50px">
                                                    @if($g->logo_img == null)
                                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/group-default-logo.png')?>" style="width: 120px; height: 120px; float: left">
                                                    @else
                                                        <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$g->logo_img}}" style="width: 120px; height: 120px; float: left;">
                                                    @endif
                                                    <div class="td-content">
                                                        <a href=""><h2>{{$g->name}}</h2></a>
                                                        @if($g->role_id == 1)
                                                            <h3>Administrator</h3>
                                                        @else
                                                            <h3>Member</h3>
                                                        @endif
                                                        <p>{{$g->description}}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-events" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-calendar"></i> Joined Events</h2>
                                </div>
                                <div class="detail_content">
                                    <div class="org-oppor-detail">
                                        <div class="img-logo">
                                            <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                                        </div>
                                        <div class="detail-text">
                                            <a href=""><h2>Skymedia Garden</h2></a>
                                            <h3>Opportunity</h3>
                                            <p>He is very good and talent man. He helped us with his excellent ability. Thanks.</p>
                                        </div>
                                    </div>
                                    <div class="org-oppor-detail">
                                        <div class="img-logo">
                                            <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                                        </div>
                                        <div class="detail-text">
                                            <a href=""><h2>Skymedia Garden</h2></a>
                                            <h3>Opportunity</h3>
                                            <p>He is very good and talent man. He helped us with his excellent ability. Thanks.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-members" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-users"></i> My Friends </h2>
                                </div>
                                <div class="detail_content">
                                    <h3>Friends</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Friend Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($friend as $f)
                                            <tr>
                                                <td style="text-align: left; padding-left: 50px;">
                                                    @if($f->logo_img == null)
                                                        <img src="{{url('/img/logo/member-default-logo.png')}}" class="img-circle" style="width: 60px">
                                                    @else
                                                        <img src="{{url('/uploads')}}/{{$f->logo_img}}" class="img-circle" style="width: 60px">
                                                    @endif
                                                    <a href="{{url('/profile')}}/{{$f->id}}"><strong>{{$f->first_name}} {{$f->last_name}}</strong></a>
                                                </td>
                                                <td>{{$f->email}}</td>
                                                <td>{{$f->contact_number}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="tab-contact" class="tab-pane">
                            <div class="panel-body">
                                <div class="detail_header">
                                    <h2><i class="fa fa-info-circle"></i> Organization Contact</h2>
                                </div>
                                <div class="detail_content">
                                    <p>To send a message to this organization,please fill out blow forms and click send.</p></br>
                                    <strong><h3>Subject</h3></strong>
                                    <input type="text" class="form-control">
                                    <strong><h3>Message</h3></strong>
                                    <textarea rows="10" class="form-control"></textarea>
                                    <button class="btn btn-primary pull-right" style="margin-top: 15px; min-width: 120px;"> Send </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="footer">
        <div class="pull-right">
        </div>
        <div class="copy-right">
            <strong>My Voluntier &copy; 2018.</strong> All Rights Reserved
        </div>
    </div>
    </div>
@endif
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
<script src="<?=asset('js/plugins/footable/footable.all.min.js')?>"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3n1_WGs2PVEv2JqsmxeEsgvrorUiI5Es"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.member-table').footable();
            var $image = $(".profile-back-image > img")

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function (e) {
                            $inputImage.val("");
                            $image.attr('src', e.target.result);
                        };
                        $('#upload_logo').submit();
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }
        });


        google.maps.event.addDomListener(window, 'load', init);
        function init() {
            var myLatLng = {lat: parseFloat($('#lat_val').val()), lng: parseFloat($('#lng_val').val())};
            var mapOptions = {
                zoom: 16,
                center: myLatLng,
                // Style for Google Maps
                styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
            };
            // Get all html elements for map
            var mapElement = document.getElementById('pos_map');
            // Create the Google Map using elements
            var map = new google.maps.Map(mapElement, mapOptions);
            var marker1 = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: '<?=asset('img/google_map/pin.png')?>',
            });
            marker1.addListener('click', function() {
                infowindow.open(map, marker1);
            });
        }
    </script>
</body>
</html>
