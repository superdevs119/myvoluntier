@extends('organization.layout.master')

@section('css')
@endsection

@section('content')
<div class="content-panel">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12 animated fadeInRight profile-panel">
                <div class="col-lg-8 profile-info">
                    <div class="profile-image">
                        <div class="profile-image-hover">
                            <img <?php if($oppr_info->logo_img == NULL){ ?>src="<?=asset('img/logo/opportunity-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$oppr_info->logo_img}} <?php }?>" class="img-circle circle-border m-b-md" alt="profile">
                        </div>
                    </div>

                    <div class="profile-text">
                        <h1 class="no-margins"><strong>{{$oppr_info->title}}</strong></h1></br>
                        <div class="inner-content">
                            <h3 class="no-margins">{{$oppr_info->opportunity_type}}</h3>
                            <p>({{$oppr_info->start_date}} to {{$oppr_info->end_date}})</p><br>
                            <h3 class="no-margins">{{$oppr_info->activity}}</h3><br>
                            {{--<div class="is-joint">--}}
                                {{--<button class="btn btn-primary"><i class="fa fa-chain"></i> Join</button>--}}
                                {{--<p>You are a member. </p>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 profile-view-logo">
                    <div class="header">
                        <h1>Hosted By</h1>
                    </div>
                    <div class="content">
                        <img <?php if($oppr_info->org_logo == NULL){ ?>src="<?=asset('img/logo/organization-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$oppr_info->org_logo}} <?php }?>" class="img-circle circle-border m-b-md" alt="profile">
                        <h3><i class="fa fa-star"></i> <a href="{{url('/profile')}}/{{$oppr_info->org_id}}"> {{$oppr_info->org_name}} </a> <i class="fa fa-star"></i></h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 animated fadeInRight impact-panel">
                <div class="oppor-details">
                    <div class="tabs-container">
                        <div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-details"> Details</a></li>
                                <li><a data-toggle="tab" href="#tab-members"> Members</a></li>
                            </ul>
                            <div class="tab-content ">
                                <div id="tab-details" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="detail_header">
                                            <h2><i class="fa fa-ioxhost"></i> Opportunity Details</h2>
                                        </div>
                                        <div class="detail_content">
                                            <div class="col-md-7">
                                                <div class="contents">
                                                    <h3>Opportunity Type:</h3>
                                                    <p>{{$oppr_info->opportunity_type}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Opportunity Code:</h3>
                                                    <p>{{$oppr_info->id}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Contact Name:</h3>
                                                    <p>{{$oppr_info->contact_name}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Contact Email:</h3>
                                                    <p>{{$oppr_info->contact_email}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Phone number:</h3>
                                                    <p>{{$oppr_info->contact_number}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Qualifications:</h3>
                                                    <p>{{$oppr_info->qualification}}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-5 g-map">
                                                <div id="pos_map" style="height: 240px;">
                                                    <input type="hidden" id="lat_val" value="{{$oppr_info->lat}}">
                                                    <input type="hidden" id="lng_val" value="{{$oppr_info->lng}}">
                                                </div>
                                                <div class="contents">
                                                    <h3>Address:</h3>
                                                    <p>{{$oppr_info->street_addr1}}, {{$oppr_info->city}}, {{$oppr_info->state}}, {{$oppr_info->zipcode}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Date:</h3>
                                                    <p>{{$oppr_info->start_date}} - {{$oppr_info->end_date}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Time:</h3>
                                                    <p>{{$oppr_info->start_at}} - {{$oppr_info->end_at}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Days of Week:</h3>
                                                    <p>{{$oppr_info->weekdays}}</p>
                                                </div>
                                                <div class="contents">
                                                    <h3>Minimum Age:</h3>
                                                    <p>{{$oppr_info->min_age}}</p>
                                                </div>
                                                {{--<div class="contents">--}}
                                                    {{--<h3>Opportunity Type:</h3>--}}
                                                    {{--<p>Volunteer Service</p>--}}
                                                {{--</div>--}}
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-members" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="detail_header">
                                            <h2><i class="fa fa-users"></i> Opportunity Members</h2>
                                        </div>
                                        <div class="detail_content">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($oppr_info->opportunity_member as $om)
                                                    <tr>
                                                        <?php $member_info = \App\User::find($om->user_id); ?>
                                                        <td>{{$member_info->id}}</td>
                                                        <td>{{$member_info->first_name}} {{$member_info->last_name}}</td>
                                                        <td>{{$member_info->email}}</td>
                                                        <td>{{$member_info->contact_number}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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

@endsection

@section('script')
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3n1_WGs2PVEv2JqsmxeEsgvrorUiI5Es"></script>


        <script type="text/javascript">
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
@endsection