@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <link href="<?=asset('css/star-rating.min.css')?>" rel="stylesheet">
    <style>
        .v-logo{float: left; margin-left: 40px; width: 100px;}
        .o-logo{float: right; margin-right: 40px; width: 100px;}
        .v-name{float: left; margin-left: 40px; width: 100px; text-align: center}
        .o-name{float: right; margin-right: 40px; width: 100px; text-align: center}
        .w-mins{font-weight: bold; color: red; text-align: center; margin-top: -30px;}
        .reg-content{padding-top: 5px}
        .reg-content p{margin-bottom: 2px}
        .submitted-time{font-size: 15px}
        .worked-time{font-size: 15px}
        .review{display: none; border: 1px solid#dddddd; margin: 10px 15px 0px 15px; padding: 0 0 10px 0}
    </style>
<style>
    table img{width: 60px}
</style>
@endsection
<div class="content-panel">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12 animated fadeInRight impact-panel" style="margin-top: 0">
                <div class="impact-tracked-hours">
                    <div class="modal inmodal" id="track_process" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated flipInY">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title add_hours_modal_title">Process Tracked Hours</h4>
                                    <h3>Please approve hours,your volunteers logged!</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 reg-content logo_viewer">
                                        <img src="" class="img-circle v-logo">
                                        <img src="<?=asset('img/logo/arrow.png')?>" style="width: 100px; margin-left: 65px">
                                        <img src="" class="img-circle o-logo">
                                    </div>
                                    <div class="col-md-12 reg-content" style="clear: both">
                                        <p class="v-name"></p>
                                        <p class="o-name"></p>
                                    </div>
                                    <div class="col-md-12 reg-content">
                                        <h2 class="w-mins"></h2>
                                    </div>
                                    <div class="col-md-12 reg-content private-opp">
                                        <p style="float: left; margin-top: 8px;">This is private opportunity volunteer has created to add hours: &nbsp;</p>
                                        <a style="float: right" href="" class="opp-public btn btn-primary">Make Public</a>
                                    </div>

                                    <div class="col-md-12 reg-content">
                                        <p style="float: left"><strong>Worked Period: &nbsp;&nbsp;&nbsp;</strong></p><strong><p class="worked-time"></p></strong>
                                    </div>
                                    <div class="col-md-12 reg-content">
                                        <p style="float: left"><strong>Submitted Time: &nbsp;</strong></p><strong><p class="submitted-time"></p></strong>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="col-md-12 reg-content">
                                        <p><strong>Comments From Volunteer: </strong></p>
                                        <textarea class="form-control track-comment" rows="3" placeholder="You can enter Comments Here" readonly></textarea>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="col-md-12 reg-content">
                                        <label> <input type="checkbox" id="allow_review"> Give Review to Volunteer</label>
                                    </div>
                                    <div style="clear: both"></div>
                                    <div class="review">
                                        <div class="col-md-12 reg-content">
                                            <p><strong>Review: </strong></p>
                                            <div class="rating-stars"><input id="input-rating" class="rating-loading volunteer-rate" data-min="0" data-max="5" data-step="0.1" data-size="xs" value="4.5"></div>
                                            <p><strong>Comments: </strong></p>
                                            <textarea class="form-control review-comment" rows="3" placeholder="You can enter Comments Here"></textarea>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                </div>
                                <input type="hidden" id="track_id">
                                <div style="clear: both;"></div>
                                <div class="modal-footer">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_close">Close</button>
                                        <button type="button" id="btn_decline" class="btn btn-danger">Decline</button>
                                        <button type="button" id="btn_approve" class="btn btn-primary">Approve</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="min-width:300px; float: right; padding: 0">
                        <input type="text" class="form-control m-b" id="filter"
                               placeholder="Search in table">
                    </div>
                    <table class="confirm-table table table-stripped" data-page-size="10" data-filter=#filter>
                        <thead>
                        <tr>
                            <th data-hide="phone,tablet">Volunteer</th>
                            <th data-hide="phone,tablet">Opportunity</th>
                            <th>Worked Date</th>
                            <th data-hide="phone,tablet">Worked Mins</th>
                            <th>Submitted Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="table_pending_view">
                        @foreach($tracks as $t)
                            <tr id="track{{$t['track_id']}}">
                                <td style="text-align: left; padding-left: 20px">
                                    <a href="{{url('/')}}/profile/{{$t['volunteer_id']}}" target="_blank">
                                        @if($t['volunteer_logo'] == null)
                                            <img alt="image" class="img-circle" src="<?=asset('img/logo/member-default-logo.png')?>"> <strong>{{$t['volunteer_name']}}</strong>
                                        @else
                                            <img alt="image" class="img-circle" src="<?=asset('uploads')?>/{{$t['volunteer_logo']}}"> <strong>{{$t['volunteer_name']}}</strong>
                                        @endif
                                    </a>
                                </td>
                                <td style="text-align: left; padding-left: 20px">
                                    @if($t['opportunity_status'] != 0)
                                        <a href="{{url('/')}}/organization/edit_opportunity/{{$t['opportunity_id']}}" target="_blank">
                                            @if($t['opportunity_logo'] == null)
                                                <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>"> <strong>{{$t['opportunity_name']}}</strong>
                                            @else
                                                <img alt="image" class="img-circle" src="<?=asset('uploads')?>/{{$t['opportunity_logo']}}"> <strong>{{$t['opportunity_name']}}</strong>
                                            @endif
                                        </a>
                                    @else
                                        <img alt="image" class="img-circle" src="<?=asset('img/logo/opportunity-default-logo.png')?>"> <strong>{{$t['opportunity_name']}}</strong>(Private)
                                    @endif
                                </td>
                                <td>{{$t['logged_date']}}</td>
                                <td>{{$t['logged_mins']}}</td>
                                <td>{{$t['updated_at']}}</td>
                                <td>
                                    <input type="hidden" class="track_id" value="{{$t['track_id']}}">
                                    <input type="hidden" class="volunteer_name" value="{{$t['volunteer_name']}}">
                                    <input type="hidden" class="volunteer_logo" value="{{$t['volunteer_logo']}}">
                                    <input type="hidden" class="opportunity_id" value="{{$t['opportunity_id']}}">
                                    <input type="hidden" class="opportunity_name" value="{{$t['opportunity_name']}}">
                                    <input type="hidden" class="opportunity_logo" value="{{$t['opportunity_logo']}}">
                                    <input type="hidden" class="worked_date" value="{{$t['logged_date']}}">
                                    <input type="hidden" class="started_time" value="{{$t['started_time']}}">
                                    <input type="hidden" class="ended_time" value="{{$t['ended_time']}}">
                                    <input type="hidden" class="worked_mins" value="{{$t['logged_mins']}}">
                                    <input type="hidden" class="submitted_time" value="{{$t['updated_at']}}">
                                    <input type="hidden" class="volunteer_comment" value="{{$t['comment']}}">
                                    <input type="hidden" class="opportunity_type" value="{{$t['opportunity_status']}}">
                                    <a type="button" class="btn btn-primary btn_action" data-toggle="modal" data-target="#track_process">Action</a>
                                </td>
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
@section('content')
@endsection

@section('script')
    <script src="<?=asset('js/plugins/footable/footable.all.min.js')?>"></script>
    <script src="<?=asset('js/star-rating.min.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('.confirm-table').footable();
            $('.volunteer-rate').rating();
        });

        $('#allow_review').change(function() {
            if($(this).is(":checked")) {
                $('.review').show();
            }else{
                $('.review').hide();
            }
        });

        $('.btn_action').on('click',function () {
            $('#allow_review').attr("checked", false);
            $('.review-comment').val('');
            $('.review').hide();
            $('.private-opp').hide();
            var track = $(this).parent().find('.track_id').val();
            var v_name = $(this).parent().find('.volunteer_name').val();
            var v_logo = $(this).parent().find('.volunteer_logo').val();
            var o_id = $(this).parent().find('.opportunity_id').val();
            var o_name = $(this).parent().find('.opportunity_name').val();
            var o_logo = $(this).parent().find('.opportunity_logo').val();
            var w_date = $(this).parent().find('.worked_date').val();
            var s_time = $(this).parent().find('.started_time').val();
            var e_time = $(this).parent().find('.ended_time').val();
            var w_mins = $(this).parent().find('.worked_mins').val();
            var submit_t = $(this).parent().find('.submitted_time').val();
            var v_comment = $(this).parent().find('.volunteer_comment').val();
            var o_type = $(this).parent().find('.opportunity_type').val();

            $('#track_id').val(track);
            if(v_logo != ''){
                $('.v-logo').attr('src', SITE_URL+"uploads/"+v_logo);
            }else{
                $('.v-logo').attr('src', SITE_URL+"img/logo/member-default-logo.png");
            }
            if(o_logo != ''){
                $('.o-logo').attr('src', SITE_URL+"uploads/"+o_logo);
            }else{
                $('.o-logo').attr('src', SITE_URL+"img/logo/opportunity-default-logo.png");
            }
            $('.opp-public').attr('href', SITE_URL+"organization/edit_opportunity/"+o_id);
            $('.v-name').text(v_name);
            $('.o-name').text(o_name);
            $('.w-mins').text(w_mins+"mins");
            $('.track-comment').text(v_comment);
            $('.submitted-time').text(submit_t);
            $('.worked-time').text(w_date+' '+s_time+' to '+e_time);
            if(o_type == 0){
                $('.private-opp').show();
            }
        })

        $('#btn_approve').on('click',function () {
            var track_id = $('#track_id').val();
            var is_review = 0;
            if($('#allow_review').is(":checked")) {
                is_review = 1;
            }
            var review_score = $('#input-rating').val();
            var review_comment = $('.review-comment').val();
            var url = API_URL + 'organization/track/approve';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log();
            var type = "post";
            var formData = {
                track_id: track_id,
                is_review: is_review,
                review_score: review_score,
                review_comment: review_comment,
            }
            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    $('#'+'track'+track_id).remove();
                    $('#track_process').modal('toggle');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        $('#btn_decline').on('click',function () {
            var track_id = $('#track_id').val();
            var url = API_URL + 'organization/track/decline';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log();
            var type = "post";
            var formData = {
                track_id: track_id,
            }
            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    $('#'+'track'+track_id).remove();
                    $('#track_process').modal('toggle');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection
