@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        img{width: 70px;}
        .list-group-item{min-height:100px;}
        .approved{font-size: 15px; margin-top: 10px; margin-bottom: 0; display: none}
        .divider{margin: 0 !important;}
    </style>
@endsection

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel" style="margin-top: 0">
                    <div class="panel-body">
                        <div class="detail_header">
                            <h2><i class="fa fa-bell"></i> Notifications</h2>
                            <div class="divider"></div>
                            <ul class="list-group elements-list">
                                @foreach($alert as $a)
                                    @if($a['alert_type'] == \App\Alert::ALERT_FOLLOW || $a['alert_type'] == \App\Alert::ALERT_ACCEPT || $a['alert_type'] == \App\Alert::ALERT_DECLINE)
                                    <li class="list-group-item" @if($a['is_checked'] == 0) style="background: #efefef" @endif>
                                        <div class="oppor-logo">
                                            @if($a['sender_type']=='organization')
                                                @if($a['sender_logo']==null)
                                                    <img alt="image" class="img-circle" src="<?=asset('img/logo/organization-default-logo.png') ?>">
                                                @else
                                                    <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$a['sender_logo']}}">
                                                @endif
                                            @elseif($a['sender_type']=='volunteer')
                                                @if($a['sender_logo']==null)
                                                    <img alt="image" class="img-circle" src="<?=asset('img/logo/member-default-logo.png') ?>">
                                                @else
                                                    <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$a['sender_logo']}}">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="oppor-content">
                                            <small class="pull-right text-muted"> {{$a['date']}}</small>
                                            <h2><a href="{{url('/organization/profile')}}/{{$a['sender_id']}}"><strong>{{$a['sender_name']}}</strong></a> {{$a['contents']}}</h2>
                                            <h3><i class="fa fa-star"></i> {{$a['sender_type']}} <i class="fa fa-star"></i></h3>
                                            <div class="small m-t-xs">

                                            </div>
                                        </div>
                                    </li>
                                     @elseif($a['alert_type'] == \App\Alert::ALERT_CONNECT_CONFIRM_REQUEST || $a['alert_type'] == \App\Alert::ALERT_TRACK_CONFIRM_REQUEST)
                                     <li class="list-group-item" @if($a['is_checked'] == 0) style="background: #efefef" @endif>
                                         <div class="oppor-logo">
                                             @if($a['sender_type']=='organization')
                                                 @if($a['sender_logo']==null)
                                                     <img alt="image" class="img-circle" src="<?=asset('img/logo/organization-default-logo.png') ?>">
                                                 @else
                                                     <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$a['sender_logo']}}">
                                                 @endif
                                             @elseif($a['sender_type']=='volunteer')
                                                 @if($a['sender_logo']==null)
                                                     <img alt="image" class="img-circle" src="<?=asset('img/logo/member-default-logo.png') ?>">
                                                 @else
                                                     <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$a['sender_logo']}}">
                                                 @endif
                                             @endif
                                         </div>
                                         <div class="oppor-content">
                                             <small class="pull-right text-muted"> {{$a['date']}}</small>
                                             <h2><a href="{{url('/organization/profile')}}/{{$a['sender_id']}}"><strong>{{$a['sender_name']}}</strong></a> {{$a['contents']}}</h2>
                                             <h3><i class="fa fa-star"></i> {{$a['sender_type']}} <i class="fa fa-star"></i></h3>
                                             <div class="small m-t-xs">
                                                 <input type="hidden" class="sender_id" value="{{$a['sender_id']}}">
                                                 <input type="hidden" class="alert_type" value="{{$a['alert_type']}}">
                                                 @if($a['alert_type'] == \App\Alert::ALERT_CONNECT_CONFIRM_REQUEST)
                                                    @if($a['status'] == 0)
                                                    <button class="btn btn-primary btn-accept">Accept</button>
                                                    <p class="approved"><i class="fa fa-check-square-o"></i> This request is approved.</p>
                                                    @else
                                                        <p class="approved" style="display: block"><i class="fa fa-check-square-o"></i> This request is approved.</p>
                                                    @endif
                                                 @elseif($a['alert_type'] == \App\Alert::ALERT_TRACK_CONFIRM_REQUEST)
                                                     @if($a['status'] == 0)
                                                         <a href="{{url('/organization/track')}}" type="button" class="btn btn-primary" style="color: white">Process</a>
                                                     @else
                                                         <p class="approved" style="display: block"><i class="fa fa-check-square-o"></i> This request is approved.</p>
                                                     @endif
                                                 @endif
                                             </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
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
            $('.group-table').footable();
        });

        $('.btn-accept').on('click',function () {
            var current_button = $(this);
            var sender_id = $(this).parent().find('.sender_id').val();
            var alert_type = $(this).parent().find('.alert_type').val();
            if(alert_type == 3){
                var url = API_URL + 'organization/acceptFriend';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                console.log();
                var type = "POST";
                var formData = {
                    id: sender_id
                }
                $.ajax({
                    type: type,
                    url: url,
                    data: formData,
                    success: function (data) {
                        current_button.hide();
                        current_button.parent().find('.approved').show();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    </script>
@endsection
