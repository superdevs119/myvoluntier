@extends('volunteer.layout.master')
@section('css')
    <link href="<?=asset('css/plugins/fullcalendar/fullcalendar.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/fullcalendar/fullcalendar.print.css')?>" rel='stylesheet' media='print'>
    <link href="<?=asset('css/plugins/iCheck/custom.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
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
    </style>
@endsection
@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row" style="background-color: #fff">
                <div class="col-lg-12 animated fadeInRight tracking-panel">
                    <div class="panel-body">
                        <div class="track-add-hour">
                            <div class="col-lg-3">
                                <div class="ibox float-e-margins">
                                    <h3 style="float: left">My Opportunities</h3>
                                    <a href="#" data-toggle="modal" data-target="#add_opportunity" class="btn-primary" style="float: right;padding: 5px 8px;"><i class="fa fa-plus"></i></a>
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
                                                    <div class="col-md-12 reg-content" style="display: none;">
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
                                                        <input id="opp_not_exist" type="checkbox"> <label for="opp_not_exist"> Organization does not exist</label>
                                                    </div>
                                                    <div class="col-md-12 reg-content opp_private_div">
                                                        <p><strong>Private Opportunity Name: </strong></p>
                                                        <input type="text" name="private_opp_name" id="private_opp_name" class="form-control" placeholder="Enter Email Addresses to Share Your Profile"  autocomplete="off"/>
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
                            {{--<button class="btn btn-primary pull-right">Save Logs</button>--}}
                        </div>
                    </div>

                    <div class="modal inmodal" id="add_hours" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated flipInY">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Adding Hours</h4>
                                    <h3>Please select opportunity and add hours!</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 reg-content">
                                        <p><strong>Opportunity: </strong></p>
                                        <select class="add_select_opportunity form-control" id="opp_id" style="height: 34px;">
                                            <option></option>
                                            @foreach($oppr as $op)
                                                <option value="{{$op->id}}">{{$op->title}}</option>
                                            @endforeach
                                        </select>
                                        <p class="p_invalid" id="empty_opportunity_alert" style="display: none">Please Select Opportunity!</p>
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
                                    <div class="col-md-12 reg-content" style="display: none;">
                                        <p><strong>Comments: </strong></p>
                                        <textarea class="form-control" name="comments" id="comments" rows="5" placeholder="You can enter Comments Here"></textarea>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="modal-footer">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_close">Close</button>
                                        <button type="button" id="btn_add_hours" class="btn btn-primary">Submit</button>
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
            <script src="<?=asset('js/jquery-ui.custom.min.js')?>"></script>
            <script src="<?=asset('js/plugins/select2/select2.full.min.js')?>"></script>
            <script src="<?=asset('js/plugins/footable/footable.all.min.js')?>"></script>
            <script src="<?=asset('js/plugins/paginate/paginate.js')?>"></script>
            <script src="<?=asset('js/plugins/paginate/jquery-asPaginator.js')?>"></script>
            <!-- jQuery UI custom -->
            <script src="<?=asset('js/tracking-action.js')?>"></script>
        @endsection