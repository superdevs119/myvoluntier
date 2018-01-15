@extends('volunteer.layout.master')
@section('css')
    <link href="<?=asset('css/plugins/fullcalendar/fullcalendar.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/fullcalendar/fullcalendar.print.css')?>" rel='stylesheet' media='print'>
    <link href="<?=asset('css/plugins/iCheck/custom.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/paginate/asPaginator.css')?>" rel="stylesheet">
    <style>
        .select2-container {
            z-index: 10500 !important; /* has to be larger than 1050 */
            width: 100% !important;
        }
        .select2-search__field{
            z-index: 10500 !important; /* has to be larger than 1050 */
        }
        .org_email_div{display: none;}
        .opp_div{display: none;}
        .opp_check_div{display: none;}
        .opp_private_div{display: none;}
        #opp_date_div{display: none;}
        .private-bg{background-color: #f8ac59; color: #fff;}
        .reg-content p{margin: 10px 0 2px;}
        .confirmed_track{color: red; display: none;}
        .declined_track{color: red; display: none;}
        td img{width: 60px;}

        #paginator-content {
            height: 100px;
            margin-top: 10px;
        }

        h1 {
            margin-bottom: 40px;
        }

        .asPaginator > a {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            text-decoration: none;
            border: 1px solid #979797;
        }

        .asPaginator> a.asPaginator_active {
            background-color: #ddd;
        }
    </style>
@endsection
@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight tracking-panel">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-clock-o"></i> Add Hours </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-gavel"></i> My Activities </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-spinner"></i>Pending Approvals </a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="track-add-hour">
                                        <div class="col-lg-3">
                                            <div class="ibox float-e-margins">
                                                <h3 style="float: left">My Opportunities</h3>
                                                <a href="#" data-toggle="modal" data-target="#add_opportunity" class="btn-primary add_opportunity_dlg" style="float: right;padding: 5px 8px;"><i class="fa fa-plus"></i></a>
                                                <div style="clear: both"></div>
                                                <div class="ibox-content">
                                                    <div id='external-events'>
                                                        @foreach($oppr as $op)
                                                            @if($op->type == 1)
                                                                <div class='external-event navy-bg' value="{{$op->id}}">{{$op->title}}</div>
                                                            @else
                                                                <div class='external-event private-bg' value="{{$op->id}}">{{$op->title}}</div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal inmodal" id="add_opportunity" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <h4 class="modal-title">Join to Opportunity</h4>
                                                                <h3>You can join to Opportunity to add hours here!</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-12 reg-content">
                                                                    <p><strong>Organization: </strong></p>
                                                                    <select class="select_organization form-control" id="org_name" style="height: 34px;">
                                                                        <option></option>
                                                                        @foreach($org_name as $o_name)
                                                                        <option value="{{$o_name->id}}">{{$o_name->org_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <p class="p_invalid" id="invalid_org_name_alert" style="display: none">Please select Organization.</p>
                                                                </div>
                                                                <div class="col-md-12 reg-content org_not_exist" style="display: none">
                                                                    <input id="org_not_exist" type="checkbox"> <label for="org_not_exist"> Organization does not exist</label>
                                                                </div>
                                                                <div class="col-md-12 reg-content org_email_div">
                                                                    <p><strong>Organization Email: </strong></p>
                                                                    <input type="text" name="org_emails" id="org_emails" class="form-control" placeholder="Enter Email Addresses to Share Your Profile"  autocomplete="off"/>
                                                                    <p class="p_invalid" id="invalid_org_email_alert" style="display: none">Please enter Organization Email.</p>
                                                                </div>
                                                                <div class="col-md-12 reg-content opp_div">
                                                                    <p><strong>Opportunity: </strong></p>
                                                                    <select class="select_opportunity form-control" id="opp_name" style="height: 34px;">
                                                                        <option></option>
                                                                    </select>
                                                                    <p class="p_invalid" id="invalid_opp_name_alert" style="display: none">Please select Opportunity.</p>
                                                                    <input id="opp_not_exist" type="checkbox"> <label for="opp_not_exist"> Opportunity does not exist</label>
                                                                </div>
                                                                <div class="col-md-12 reg-content opp_private_div">
                                                                    <p><strong>Private Opportunity Name: </strong></p>
                                                                    <input type="text" name="private_opp_name" id="private_opp_name" class="form-control" placeholder="Enter Private Opportunity Name Here"  autocomplete="off"/>
                                                                    <p class="p_invalid" id="invalid_private_name_alert" style="display: none">Please enter Private Opportunity Name to add hours.</p>
                                                                </div>
                                                                <div class="col-md-12 reg-content form-group" id="opp_date_div">
                                                                    <p><strong>Opportunity End Date: </strong></p>
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="end_date" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div style="clear: both;"></div>
                                                                <p class="p_invalid" id="opportunity_exist_alert" style="display: none">You have joined to Opportunity already!</p>
                                                            </div>
                                                            <div style="clear: both;"></div>
                                                            <div class="modal-footer">
                                                                <div class="col-md-12">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_close">Close</button>
                                                                    <button type="button" id="btn_add_opp" class="btn btn-primary">Add Opportunity</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ibox float-e-margins">
                                                <h3>How to Add Hours?</h3>
                                                <div class="ibox-content">
                                                    It's easy! You can add hours by CLICKING calendar.<br/>
                                                    If so you could see dialog box.
                                                    There, select Opportunity and input time range you have worked.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="ibox float-e-margins">
                                                <h2 style="margin-top: -5px;">My Work Calendar</h2>
                                                <div class="ibox-content">
                                                    <div id="calendar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="selected_date">
                                        <input type="hidden" id="is_edit" value="0">
                                        <input type="hidden" id="track_id" value="0">
                                        <input type="hidden" id="is_from_addhour" value="0">
                                        <input type="hidden" id="is_no_org" value="0">
                                        <input type="hidden" id="is_link_exist" value="0">
                                        {{--<button class="btn btn-primary pull-right">Save Logs</button>--}}
                                    </div>
                                </div>

                                <div class="modal inmodal" id="add_hours" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated flipInY">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title add_hours_modal_title">Adding Hours</h4>
                                                <h3>Please select opportunity and add hours!</h3>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12 reg-content opp_select_div">
                                                    <p><strong>Opportunity: </strong></p>
                                                    <select class="add_select_opportunity form-control" id="opp_id" style="height: 34px;">
                                                        <option></option>
                                                        @foreach($oppr as $op)
                                                            <option value="{{$op->id}}">{{$op->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="p_invalid" id="empty_opportunity_alert" style="display: none">Please Select Opportunity!</p>
                                                </div>
                                                <div class="col-md-12 reg-content private_opp_div"  style="display: none">
                                                    <p><strong>Private Opportunity: </strong></p>
                                                    <input id="private_opp_name_hours" class="form-control">
                                                </div>
                                                <div class="col-md-12 reg-content">
                                                    <p><strong>Opportunity does not exist?</strong> You can Join to new opportunity <a id="add_on_addtime" href="#add_opportunity" data-toggle="modal" data-dismiss="modal">Here</a>.</p>
                                                </div>
                                                <div class="col-md-5 reg-content">
                                                    <p><strong>From: </strong></p>
                                                    <select class="form-control" id="start_time">
                                                        <?php
                                                        $start = "00:00";
                                                        $end = "23:30";
                                                        $tStart = strtotime($start);
                                                        $tEnd = strtotime($end);
                                                        $tNow = $tStart;

                                                        while($tNow <= $tEnd){
                                                            $time = date("g:ia",$tNow);
                                                            $val = date("H:i",$tNow)
                                                        ?>
                                                            <option value="{{$val}}">{{$time}}</option>
                                                        <?php    $tNow = strtotime('+30 minutes',$tNow);
                                                        }?>
                                                    </select>
                                                    </div>
                                                <div class="col-md-5 reg-content">
                                                    <p><strong>To: </strong></p>
                                                    <select class="form-control" id="end_time">
                                                        <?php
                                                        $start = "00:00";
                                                        $end = "23:30";
                                                        $tStart = strtotime($start);
                                                        $tEnd = strtotime($end);
                                                        $tNow = $tStart;

                                                        while($tNow <= $tEnd){
                                                        $time = date("g:ia",$tNow);
                                                        $val = date("H:i",$tNow)
                                                        ?>
                                                        <option value="{{$val}}">{{$time}}</option>
                                                        <?php    $tNow = strtotime('+30 minutes',$tNow);
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2" style="padding: 35px 0 0 0;">
                                                    <p id="hours"></p>
                                                </div>
                                                <div style="clear: both;"></div>
                                                <div class="col-md-12 reg-content">
                                                    <p><strong>Comments: </strong></p>
                                                    <textarea class="form-control" name="adding_hours_comments" id="adding_hours_comments" rows="5" placeholder="You can enter Comments Here"></textarea>
                                                </div>
                                                <div class="col-md-12 reg-content confirmed_track">
                                                    <p><strong>This track is already Confirmed. You cannot change confirmed Track. </strong></p>
                                                </div>
                                                <div class="col-md-12 reg-content declined_track">
                                                    <p><strong>This track is Declined by Organization. You cannot change declined Track. </strong></p>
                                                </div>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="modal-footer">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_close">Close</button>
                                                    <button type="button" id="btn_remove_hours" class="btn btn-primary">Remove</button>
                                                    <button type="button" id="btn_add_hours" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal inmodal" id="unavailable" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h3>Sorry, You cannot add hours on Future time.</h3>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <select class="form-control m-b" name="action_range" id="action_range">
                                        <option value="30">Last Month</option>
                                        <option value="7" selected>Last Week</option>
                                        <option value="1">Yesterday</option>
                                        <option value="0">Today</option>
                                    </select>
                                    <div style="clear: both;"></div>
                                    <table class="table_activity table table-stripped" data-page-size="10" data-filter=#filter>
                                    <tbody class="track-activity-panel">
                                    </tbody>
                                    </table>
                                    <div id="active_pager">
                                        <ul id="activity_pagination" class="pagination pull-right"></ul>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <div class="impact-panel" style="margin-top: 0">
                                        <div style="min-width:300px; float: right; padding: 0">
                                            <input type="text" class="form-control m-b" id="filter"
                                               placeholder="Search in table">
                                        </div>
                                        <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                                            <thead>
                                            <tr>
                                                <th>Opportunity</th>
                                                <th>Worked Date</th>
                                                <th data-hide="phone,tablet">Clock In</th>
                                                <th data-hide="phone,tablet">Clock Out</th>
                                                <th>Total Mins</th>
                                                <th data-hide="phone,tablet">Submitted Date</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table_pending_view">
                                            @foreach($tracks as $tr)
                                                <tr class="pending-approval" id="pending{{$tr->id}}">
                                                    <td style="text-align: left; padding-left: 20px">
                                                        @if($tr->link != 0)
                                                            <a href="{{url('/')}}/volunteer/view_opportunity/{{$tr->oppor_id}}">
                                                                @if($tr->opp_logo == '')
                                                                    <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>"> {{$tr->oppor_name}}
                                                                @else
                                                                    <img alt="image" class="img-circle" src="<?=asset('uploads')?>/{{$tr->opp_logo}}"> <strong>{{$tr->oppor_name}}</strong>
                                                                @endif
                                                            </a>
                                                        @else
                                                            <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>"> {{$tr->oppor_name}}
                                                        @endif
                                                    </td>
                                                    <td>{{$tr->logged_date}}</td>
                                                    <td>{{$tr->started_time}}</td>
                                                    <td>{{$tr->started_time}}</td>
                                                    <td>{{$tr->logged_mins}}</td>
                                                    <td>{{$tr->updated_date}}</td>
                                                    @if($tr->approv_status == 0)
                                                        <td class="label label-warning" style="display: table-cell; font-size:13px;">Pending</td>
                                                    @elseif($tr->approv_status == 1)
                                                        <td class="label label-primary" style="display: table-cell; font-size:13px;">Approved</td>
                                                    @else
                                                        <td class="label label-danger" style="display: table-cell; font-size:13px;">Declined</td>
                                                    @endif
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
                                        <div id="peending_pager">
                                            <ul id="pendding_pagination" class="pagination pull-right"></ul>
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
    <script src="<?=asset('js/plugins/fullcalendar/moment.min.js')?>"></script>
    <script src="<?=asset('js/plugins/fullcalendar/fullcalendar.min.js')?>"></script>
    <!-- jQuery UI custom -->
    <script src="<?=asset('js/jquery-ui.custom.min.js')?>"></script>
    <script src="<?=asset('js/plugins/select2/select2.full.min.js')?>"></script>
    <script src="<?=asset('js/plugins/footable/footable.all.min.js')?>"></script>
    <script src="<?=asset('js/plugins/paginate/paginate.js')?>"></script>
    <script src="<?=asset('js/plugins/paginate/jquery-asPaginator.js')?>"></script>
            {{--<script src="<?=asset('js/plugins/paginate/prism.js')?>"></script>--}}
            {{--<script src="<?=asset('js/plugins/paginate/jquery.toc.js')?>"></script>--}}
    <script src="<?=asset('js/tracking-action.js')?>"></script>


@endsection