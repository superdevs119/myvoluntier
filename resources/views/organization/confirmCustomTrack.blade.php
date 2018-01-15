@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        .v-logo{float: left; margin-left: 40px; width: 120px;}
        .o-logo{float: right; margin-right: 40px; width: 120px;}
        .v-name{float: left; margin-left: 40px; width: 120px; text-align: center}
        .o-name{float: right; margin-right: 40px; width: 120px; text-align: center}
        .w-mins{font-weight: bold; color: red; text-align: center; margin-top: -30px;}
        .reg-content{padding-top: 5px}
        .reg-content p{margin-bottom: 2px}
        .submitted-time{font-size: 15px}
        .worked-time{font-size: 15px}
        .custom-track-confirm{max-width: 600px; margin: auto; padding: 20px 10px 0px 10px; border: 1px solid#efefef; margin-bottom: 30px}
        .track-confirm-header{text-align:center; padding: 30px 0 10px 0}
        .track-confirm-header h2{font-weight: bold}
        .track-confirm-footer{float: right; padding: 30px 0 20px 0}
        .approved-alert{max-width: 600px; margin: auto; padding: 20px 10px 20px 10px; border: 1px solid#3bb44a; margin-bottom: 20px; display: none}
        .approved-alert h3{text-align: center; color: #3bb44a}
        .decline-alert{max-width: 600px; margin: auto; padding: 20px 10px 20px 10px; border: 1px solid#ff0000; margin-bottom: 20px; display: none}
        .decline-alert h3{text-align: center; color: red}
        table img{width: 60px}
    </style>
@endsection
@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 impact-panel" style="margin-top: 0">
                    <div class="track-confirm-header">
                        <h2>Confirm Tracked Hours</h2>
                    </div>
                    <div class="custom-track-confirm">
                        <input type="hidden" id="track_id" value="{{$track['track_id']}}">
                        <div class="col-md-12 reg-content logo_viewer">
                            @if($track['volunteer_logo'] == null)
                                <img alt="image" class="img-circle v-logo" src="<?=asset('img/logo/member-default-logo.png')?>">
                            @else
                                <img alt="image" class="img-circle v-logo" src="<?=asset('uploads')?>/{{$track['volunteer_logo']}}">
                            @endif
                            <img src="<?=asset('img/logo/arrow.png')?>" style="width: 120px; margin-left: 65px">
                            @if($track['opportunity_logo'] == null)
                                <img alt="image" class="img-circle o-logo" src="<?=asset('img/logo/opportunity-default-logo.png')?>">
                            @else
                                <img alt="image" class="img-circle o-logo" src="<?=asset('uploads')?>/{{$track['opportunity_logo']}}">
                            @endif
                        </div>
                        <div class="col-md-12 reg-content" style="clear: both">
                            <p class="v-name">{{$track['volunteer_name']}}</p>
                            <p class="o-name">{{$track['opportunity_name']}}</p>
                        </div>
                        <div class="col-md-12 reg-content">
                            <h2 class="w-mins">{{$track['logged_mins']}}mins</h2>
                        </div>
                        <div class="col-md-12 reg-content private-opp">
                            <p style="float: left; margin-top: 8px;">This is private opportunity volunteer has created to add hours: &nbsp;</p>
                            <a style="float: right" href="{{url('/')}}/organization/edit_opportunity/{{$track['opportunity_id']}}" class="opp-public btn btn-primary">Make Public</a>
                        </div>

                        <div class="col-md-12 reg-content">
                            <p style="float: left"><strong>Worked Period: &nbsp;&nbsp;&nbsp;</strong></p><strong><p class="worked-time">
                                    {{$track['logged_date']}} {{$track['started_time']}} to {{$track['ended_time']}}</p></strong>
                        </div>
                        <div class="col-md-12 reg-content">
                            <p style="float: left"><strong>Submitted Time: &nbsp;</strong></p><strong><p class="submitted-time">{{$track['updated_at']}}</p></strong>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-md-12 reg-content">
                            <p><strong>Comments From Volunteer: </strong></p>
                            <textarea class="form-control track-comment" rows="5" placeholder="You can enter Comments Here" readonly>{{$track['comment']}}</textarea>
                        </div>

                        <input type="hidden" id="track_id">
                        <div style="clear: both;"></div>
                        <div class="track-confirm-footer">
                            <div class="col-md-12">
                                <button type="button" id="btn_decline" class="btn btn-danger">Decline</button>
                                <button type="button" id="btn_approve" class="btn btn-primary">Approve</button>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>

                    <div class="approved-alert">
                        <h3>Tracked hours approved!</h3>
                    </div>
                    <div class="decline-alert">
                        <h3>Tracked hours declined!</h3>
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('script')
<script>
    $('#btn_approve').on('click',function () {
        var track_id = $('#track_id').val();
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
        }
        $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
                $('.approved-alert').show();
                window.setTimeout(function(){

                    // Move to a new location or you can do something else
                    window.location.href = SITE_URL;

                }, 3000);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    })

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
                $('.decline-alert').show();
                window.setTimeout(function(){

                    // Move to a new location or you can do something else
                    window.location.href = SITE_URL;

                }, 3000);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection
