@extends('volunteer.layout.master')
@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        .td-content{float: left; padding-left: 10px;}
    </style>
@endsection
@section('content')
    @if($profile_info['is_volunteer'] == 1)
    <div class="content-panel">
        <div class="profile-back-image">
            <form id="upload_logo" role="form" method="post" action="{{url('api/volunteer/profile/upload_back_img')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="current_id" value="{{$user->id}}">
                <img alt="image" <?php if($user->back_img == NULL){ ?>src="<?=asset('img/gallery/12.jpg') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$user->back_img}}" <?php }?>>
                @if($profile_info['is_my_profile'] == 1)
                <label title="Upload image file" for="inputImage" class="back-change btn btn-primary">
                    <input type="file" accept="image/*" name="file_logo" id="inputImage" class="hide"><i class="fa fa-file-image-o"></i>
                </label>
                @endif
            </form>
            <div class="org-info-logo">
                <img alt="image" <?php if($user->logo_img == NULL){ ?>src="<?=asset('img/logo/member-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$user->logo_img}}" <?php }?>>
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
                            <h1 class="no-margins"><strong>{{$user->first_name}} {{$user->last_name}}</strong></h1>
                            <div class="inner-content">
                                <h2 class="no-margins">My Summary</h2></br>
                                <p>{{$user->brif}}<p>
                                @if($profile_info['is_my_profile'] != 1)
                                <div class="is-joint">
                                    @if($profile_info['is_friend'] == 0)
                                        <button class="btn btn-primary" id="btn_connect">Connect</button>
                                        <button class="btn btn-default" id="btn_pending" style="display: none">Pending..</button>
                                    @elseif($profile_info['is_friend'] == 1)
                                        <button class="btn btn-default" id="btn_pending">Pending..</button>
                                    @elseif($profile_info['is_friend'] == 3)
                                        <button class="btn btn-warning" id="btn_accept">Accept</button>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 profile-view-logo">
                        <div class="header">
                            <h1><i class="fa fa-pie-chart"></i> Impacts</h1>
                        </div>
                        <div class="content">
                            <h1>{{$profile_info['logged_hours']}}</h1>
                            <h3>HOURS</h3>
                            @if($profile_info['is_my_profile'] == 1)
                            <a type="button" href="{{url('/volunteer/single_track')}}" class="btn btn-lg btn-danger">Add Hours</a>
                            @endif
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
                                    <li><a data-toggle="tab" href="#tab-friend"> Friends</a></li>
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
                                                        <p>{{$user->user_name}}</p>
                                                    </div>
                                                    <div class="contents">
                                                        <h3>Contact Email:</h3>
                                                        <p>{{$user->email}}</p>
                                                    </div>
                                                    <div class="contents">
                                                        <h3>Phone number:</h3>
                                                        <p>{{$user->contact_number}}</p>
                                                    </div>
                                                    <div class="contents">
                                                        <h3>Birthdate:</h3>
                                                        <p>{{$user->birth_date}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 g-map">
                                                    <div id="pos_map" style="height: 240px;">
                                                        <input type="hidden" id="lat_val" value="{{$user->lat}}">
                                                        <input type="hidden" id="lng_val" value="{{$user->lng}}">
                                                    </div>
                                                    <div class="contents">
                                                        <h3>Primary Location:</h3>
                                                        <p>{{$user->city}}, {{$user->state}}, {{$user->country}} {{$user->zipcode}}</p>
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

                                    <div id="tab-friend" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="detail_header">
                                                <h2><i class="fa fa-users"></i> My Friends </h2>
                                            </div>
                                            <div class="detail_content">
                                                <h3>Friends</h3>
                                                <table class="friend-table table table-stripped" data-page-size="10">
                                                    <thead>
                                                    <tr>
                                                        <th>Friend Name</th>
                                                        <th>Type</th>
                                                        <th>Zipcode</th>
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
                                                            <a href="{{url('/volunteer/profile')}}/{{$f->id}}">
                                                                @if($f->user_role == 'volunteer')
                                                                    <strong>{{$f->first_name}} {{$f->last_name}}</strong>
                                                                @elseif($f->user_role == 'organization')
                                                                    <strong>{{$f->org_name}}</strong>
                                                                 @endif
                                                            </a>
                                                        </td>
                                                        <td>{{$f->user_role}}</td>
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
        </div>
    @elseif($profile_info['is_volunteer'] == 0)
        <div class="content-panel">
            <div class="profile-back-image">
                <form id="upload_logo" role="form" method="post" action="{{url('api/organization/profile/upload_back_img')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="current_id" value="{{$user->id}}">
                    <img alt="image" <?php if($user->back_img == NULL){ ?>src="<?=asset('img/gallery/12.jpg') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$user->back_img}}" <?php }?>>
                </form>
                <div class="org-info-logo">
                    <img alt="image" <?php if($user->logo_img == NULL){ ?>src="<?=asset('img/logo/organization-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$user->logo_img}}" <?php }?>>
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
                                <h1 class="no-margins"><strong>{{$user->org_name}}</strong></h1>
                                <div class="inner-content">
                                    <h2 class="no-margins">{{$user->type_name}}</h2></br>
                                    <p>{{$user->brif}}<p>
                                    <div class="is-joint">
                                        @if($profile_info['is_followed'] == 0)
                                            <button class="btn btn-primary" id="btn_follow">Follow</button>
                                            <button class="btn btn-danger" id="btn_unfollow" style="display: none">Unfollow</button>
                                        @else
                                            <button class="btn btn-primary" id="btn_follow" style="display: none">Follow</button>
                                            <button class="btn btn-danger" id="btn_unfollow">Unfollow</button>
                                        @endif

                                        @if($profile_info['is_friend'] == 0)
                                            <button class="btn btn-primary" id="btn_connect">Connect</button>
                                            <button class="btn btn-default" id="btn_pending" style="display: none">Pending..</button>
                                        @elseif($profile_info['is_friend'] == 1)
                                            <button class="btn btn-default" id="btn_pending">Pending..</button>
                                        @elseif($profile_info['is_friend'] == 3)
                                            <button class="btn btn-warning" id="btn_accept">Accept</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 profile-view-logo">
                            <div class="header">
                                <h1><i class="fa fa-pie-chart"></i> Impacts</h1>
                            </div>
                            <div class="content">
                                <h1>{{$profile_info['tracks_hours']}}</h1>
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
                                        <li><a data-toggle="tab" href="#tab-friend"> Friends</a></li>
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
                                                            <p>{{$user->user_name}}</p>
                                                        </div>
                                                        <div class="contents">
                                                            <h3>Organization Name:</h3>
                                                            <p>{{$user->org_name}}</p>
                                                        </div>
                                                        <div class="contents">
                                                            <h3>Contact Email:</h3>
                                                            <p>{{$user->email}}</p>
                                                        </div>
                                                        <div class="contents">
                                                            <h3>Phone number:</h3>
                                                            <p>{{$user->contact_number}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 g-map">
                                                        <div id="pos_map" style="height: 240px;">
                                                            <input type="hidden" id="lat_val" value="{{$user->lat}}">
                                                            <input type="hidden" id="lng_val" value="{{$user->lng}}">
                                                        </div>
                                                        <div class="contents">
                                                            <h3>Primary Location:</h3>
                                                            <p>{{$user->city}}, {{$user->state}}, {{$user->country}} {{$user->zipcode}}</p>
                                                        </div>
                                                        @if($user->website)
                                                            <div class="contents">
                                                                <h3>Website:</h3>
                                                                <p><a href="" style="color: #eee;">{{$user->website}}</a></p>
                                                            </div>
                                                        @endif
                                                        <div class="contents">
                                                            <h3>Organization Type:</h3>
                                                            <p>{{$user->type_name}}</p>
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
                                                                        <a href="{{url('/organization/view_opportunity')}}/{{$opp->id}}"><h2>{{$opp->title}}</h2></a>
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

                                        <div id="tab-friend" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="detail_header">
                                                    <h2><i class="fa fa-users"></i> My Friends </h2>
                                                </div>
                                                <div class="detail_content">
                                                    <h3>Friends</h3>
                                                    <table class="friend-table table table-stripped" data-page-size="10">
                                                        <thead>
                                                        <tr>
                                                            <th>Friend Name</th>
                                                            <th>Type</th>
                                                            <th>Zipcode</th>
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
                                                                    <a href="{{url('/volunteer/profile')}}/{{$f->id}}">
                                                                        @if($f->user_role == 'volunteer')
                                                                            <strong>{{$f->first_name}} {{$f->last_name}}</strong>
                                                                        @elseif($f->user_role == 'organization')
                                                                            <strong>{{$f->org_name}}</strong>
                                                                        @endif
                                                                    </a>
                                                                </td>
                                                                <td>{{$f->user_role}}</td>
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
            </div>
            @endif
@endsection

@section('script')
    <script src="<?=asset('js/plugins/footable/footable.all.min.js')?>"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3n1_WGs2PVEv2JqsmxeEsgvrorUiI5Es"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            var $image = $(".profile-back-image > img");
            $('.friend-table').footable();

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

        $('#btn_follow').on('click',function () {
            var url = API_URL + 'volunteer/followOrganization';
            var id = $('#current_id').val();
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
                    $('#btn_unfollow').show();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        $('#btn_unfollow').on('click',function () {
            var url = API_URL + 'volunteer/unfollowOrganization';
            var id = $('#current_id').val();
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
                    $('#btn_follow').show();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        $('#btn_connect').on('click',function () {
            var url = API_URL + 'volunteer/connectOrganization';
            var id = $('#current_id').val();
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
                    $('#btn_pending').show();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        $('#btn_accept').on('click',function () {
            var url = API_URL + 'volunteer/acceptFriend';
            var id = $('#current_id').val();
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
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection