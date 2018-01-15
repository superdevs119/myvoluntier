@extends('volunteer.layout.master')
@section('css')
    <link href="<?=asset('css/plugins/codemirror/codemirror.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/codemirror/ambiance.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/daterangepicker/daterangepicker-bs3.css')?>" rel="stylesheet">
@endsection
@section('content')
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="fh-breadcrumb">
                <div class="fh-column">
                    <div class="explore-search">
                        <div class="search-box">
                            <a class="btn btn-primary" href="{{url('/volunteer/opportunity')}}" style="float: left;" title="Search NearBy"><i class="fa fa-sitemap"></i></a>
                            <div class="input-group">
                                <input type="text" id="input_keyword_search" class="form-control" placeholder="Enter Keyword"> <span class="input-group-btn">
								<button type="button" id="btn_keyword_search" class="btn btn-primary"><i class="fa fa-search"></i>
								</button></span>
                            </div>
                        </div>
                        <div class="search-options">
                            <div class="dropdown btn" style="padding: 0;">
                                <a class="dropdown-toggle count-info btn btn-primary" data-toggle="dropdown" data-placement="bottom" title="Opportunuties" href="#">Opportunity Types</a>
                                <ul class="dropdown-menu dropdown-explore">
                                    {{--<li>--}}
                                    {{--<input id="op0" type="checkbox" class="opp-search-selectall" checked>--}}
                                    {{--<label for="op0">Deselect All</label>--}}
                                    {{--</li>--}}
                                    <div id="opp-checkbox">
                                        @foreach($op_type as $key=>$ot)
                                            <li>
                                                <input id="opprtype{{$key}}" value="{{$key}}" type="checkbox" class="opp-search-checkbox">
                                                <label for="opprtype{{$key}}">{{$ot['name']}} ({{$ot['count']}})</label>
                                            </li>
                                        @endforeach
                                    </div>
                                </ul>
                            </div>
                            <div class="dropdown btn" style="padding: 0; padding-right: 9px;">
                                <a class="dropdown-toggle count-info btn btn-primary" data-toggle="dropdown" data-placement="bottom" title="Organization" href="#">Organization Types</a>
                                <ul class="dropdown-menu dropdown-explore">
                                    @foreach($og_type as $key=>$og)
                                        <li>
                                            <input id="orgtype{{$key}}" value="{{$key}}" type="checkbox" class="org-search-checkbox">
                                            <label for="orgtype{{$key}}">{{$og['name']}} ({{$og['count']}})</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="dropdown btn" style="padding: 0;">
                                <a class="dropdown-toggle count-info btn btn-default" data-toggle="dropdown" data-placement="bottom" title="Opportunuties" href="#"><i class="fa fa-calendar"></i></a>
                                <ul class="dropdown-menu dropdown-explore" style="left: -100px;">
                                    <li>
                                        <div id="date-selector">
                                            Select Date Range</br>
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="input-sm form-control" id="start" name="start" value=""/>
                                                <span class="input-group-addon">to</span>
                                                <input type="text" class="input-sm form-control" id="end" name="end" value=""/>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="explore-sidebar">
                        <ul class="list-group elements-list">
                            <?php $i=0; ?>
                            @foreach($opprs as $op)
                                <?php $i++; ?>
                                <li class="list-group-item oppr_li" value="{{$op->id}}">
                                    <div class="oppor-index"><h3>{{$i}}</h3></div>
                                    <div class="oppor-logo">
                                        <img alt="image" class="img-circle" <?php if($op->logo_img == NULL){ ?>src="<?=asset('img/logo/opportunity-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$op->logo_img}} <?php }?>">
                                    </div>
                                    <div class="oppor-content">
                                        <small class="pull-right text-muted"> {{$op->start_date}}</small>
                                        <a href="{{url('/volunteer/view_opportunity')}}/{{$op->id}}"><h2>{{$op->title}}</h2></a>
                                        <h3>Opportunity</h3>
                                        <div class="small m-t-xs">
                                            <p>{{$op->description}}</p>
                                            <p class="m-b-none">
                                                <i class="fa fa-map-marker"></i> {{$op->street_addr1}},{{$op->city}},{{$op->state}}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3n1_WGs2PVEv2JqsmxeEsgvrorUiI5Es"></script>
                <div class="full-height">
                    <div class="full-height-scroll white-bg border-left">
                        <div style="height: 80px;">
                            <div class="location_search">
                                <h3>We've found </h3>
                                <h1 id="location_search_count"> {{$opprs->count()}} </h1>
                                <h3> volunteer opportunities near </h3>
                                <form id="search_opportunity" role="form" method="get" action="{{url('volunteer/opportunity/search')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <label id="search_address">{{$search_addr['city']}}, {{$search_addr['state']}} <i class="fa fa-chevron-down"></i></label>
                                    <div class="loc_box">
                                        <input id="input_search_loc" name="input_search_loc" type="text" placeholder="Sample: City, State "><button type="button" id="btn_search_loc" class="btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="google-map" id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="pull-right">
        </div>
        <div class="copy-right">
            <strong>My Voluntier &copy; 2017.</strong> All Rights Reserved
        </div>
    </div>
@endsection

@section('script')
    <script src="<?=asset('js/plugins/daterangepicker/daterangepicker.js')?>"></script>
    <script src="<?=asset('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
    <script type="text/javascript">

        function sendRequest() {
            var opp_values = $('input:checkbox:checked.opp-search-checkbox').map(function () {
                return this.value;
            }).get();
            var org_values = $('input:checkbox:checked.org-search-checkbox').map(function () {
                return this.value;
            }).get();
            var start_Date = $('#start').val();
            var end_Date = $('#end').val();
            var location = $('#input_search_loc').val();
            var keyword = $('#input_keyword_search').val();

            var url = API_URL + 'volunteer/opportunity/getSearchResult';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log();
            var type = "get";
            var formData = {
                opp_types: opp_values,
                org_types: org_values,
                start_date: start_Date,
                end_date: end_Date,
                location: location,
                keyword: keyword,
            };
            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    $('.elements-list').empty();
                    $('#location_search_count').text(data.opprs.length);

                    var myLatLng = {lat: parseFloat(data.search_addr['lat']),lng: parseFloat(data.search_addr['lng'])};
                    var mapOptions = {
                        zoom: 16,
                        center: myLatLng,
                        // Style for Google Maps
                        styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
                    };
                    // Get all html elements for map
                    var mapElement = document.getElementById('map');
                    // Create the Google Map using elements
                    var map = new google.maps.Map(mapElement, mapOptions);

                    $.each(data.opprs, function (index,value) {
                        var number = index+1;
                        if(value.logo_img == null){
                            logo = "<?=asset('img/logo/opportunity-default-logo.png') ?>";
                        }else{
                            logo = "<?=asset('uploads') ?>/"+value.logo_img;
                        }
                        $(".elements-list").append('<li class="list-group-item oppr_li" value="'+value.id+'"><div class="oppor-index"><h3>'+(index+1)+'</h3></div><div class="oppor-logo"><img alt="image" class="img-circle" src="'+logo+'"></div><div class="oppor-content"><small class="pull-right text-muted"> '+value.start_date+'</small><a href="{{url('/volunteer/view_opportunity')}}/'+value.id+'"><h2>'+value.title+'</h2></a><h3>Opportunity</h3><div class="small m-t-xs"><p>'+value.description+'</p><p class="m-b-none"><i class="fa fa-map-marker"></i> '+value.street_addr1+','+value.city+','+value.state+'</p></div></div></li>');

                        var OpLatLng = {lat: parseFloat(value.lat), lng: parseFloat(value.lng)};
                        var marker = new google.maps.Marker({
                            position: OpLatLng,
                            map: map,
                            icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+number+'|ff1100|ffffff',
                        });
                        var contentString = '<div id="content" style="min-width: 320px">'+
                                '<div id="siteNotice">'+
                                '</div>'+'<div class="map-tooltip">'+
                                '<div class="oppor-logo">'+
                                '<img alt="image" class="img-circle" src="'+logo+'">'+
                                '</div>'+
                                '<div class="oppor-content">'+
                                '<small class="pull-right text-muted"> '+value.start_date+'</small>'+
                                '<a href="{{url('/volunteer/view_opportunity')}}/'+value.id+'"><h2>'+value.title+'<h2></a>'+
                                '<h3>Opportunity</h3>'+
                                '<div class="small m-t-xs">'+
                                '<p>'+value.description+'</p>'+
                                '<p class="m-b-none">'+
                                '<i class="fa fa-map-marker"></i> '+value.street_addr1+','+value.city+','+value.state+'</p>'+
                                '</div></div></div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });
                    });
                    $('.oppr_li').on('click',function () {
                        var op_id = $(this).val();
                        getLocation(op_id,data);
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        }
        $('#btn_keyword_search').on('click',function(){
            sendRequest();
        });

        $('#input_keyword_search').keyup(function(e){
            if(e.keyCode == 13)
                sendRequest();
        });

        $('#btn_search_loc').on('click',function () {
            sendRequest();
        });

        $('.opp-search-checkbox').on('click',function () {
            sendRequest();
        });

        $('.org-search-checkbox').on('click',function () {
            sendRequest();
        });

        $('#start').on('change',function () {
            sendRequest();
        });

        $('#end').on('change',function () {
            sendRequest();
        });
        $('#btn_search_loc').on('click',function () {
            if($('#input_search_loc').val() != ''){
                $('#search_opportunity').submit();
            }
        });
        $('#input_search_loc').keyup(function(e){
            var ser_content = $('#input_search_loc').val();
            if(e.keyCode == 13)
            {
                if(ser_content != ''){
                    if($('#input_search_loc').val() != ''){
                        $('#search_opportunity').submit();
                    }
                }
            }
        });

        function getLocation(op_id, opp_data) {
            var url = API_URL + 'volunteer/find_opportunity_on_map';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log();
            var type = "POST";
            var formData = {
                opportunity_id: op_id,
            };
            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    var myLatLng = {lat: parseFloat(data.result['lat']),lng: parseFloat(data.result['lng'])};
                    var mapOptions = {
                        zoom: 16,
                        center: myLatLng,
                        // Style for Google Maps
                        styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
                    };
                    // Get all html elements for map
                    var mapElement = document.getElementById('map');
                    // Create the Google Map using elements
                    var map = new google.maps.Map(mapElement, mapOptions);

                    $.each(opp_data.opprs, function (index,value) {
                        var number = index+1;
                        if(value.logo_img == null){
                            logo = "<?=asset('img/logo/opportunity-default-logo.png') ?>";
                        }else{
                            logo = "<?=asset('uploads') ?>/"+value.logo_img;
                        }
                        var OpLatLng = {lat: parseFloat(value.lat), lng: parseFloat(value.lng)};
                        var marker = new google.maps.Marker({
                            position: OpLatLng,
                            map: map,
                            icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+number+'|ff1100|ffffff',
                        });
                        var contentString = '<div id="content" style="min-width: 320px">'+
                                '<div id="siteNotice">'+
                                '</div>'+'<div class="map-tooltip">'+
                                '<div class="oppor-logo">'+
                                '<img alt="image" class="img-circle" src="'+logo+'">'+
                                '</div>'+
                                '<div class="oppor-content">'+
                                '<small class="pull-right text-muted"> '+value.start_date+'</small>'+
                                '<a href="{{url('/volunteer/view_opportunity')}}/'+value.id+'"><h2>'+value.title+'<h2></a>'+
                                '<h3>Opportunity</h3>'+
                                '<div class="small m-t-xs">'+
                                '<p>'+value.description+'</p>'+
                                '<p class="m-b-none">'+
                                '<i class="fa fa-map-marker"></i> '+value.street_addr1+','+value.city+','+value.state+'</p>'+
                                '</div></div></div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        if(op_id == value.id){
                            infowindow.open(map, marker);
                        }
                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });

                    })
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }


        $('.oppr_li').on('click',function () {
            var op_id = $(this).val();
            var url = API_URL + 'volunteer/find_opportunity_on_map';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log();
            var type = "POST";
            var formData = {
                opportunity_id: op_id,
            };
            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    var myLatLng = {lat: parseFloat(data.result['lat']),lng: parseFloat(data.result['lng'])};
                    var mapOptions = {
                        zoom: 16,
                        center: myLatLng,
                        // Style for Google Maps
                        styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
                    };
                    // Get all html elements for map
                    var mapElement = document.getElementById('map');
                    // Create the Google Map using elements
                    var map = new google.maps.Map(mapElement, mapOptions);

                            <?php $i=0; ?>
                            @foreach($opprs as $op)
                            <?php $i++; ?>
                    var OpLatLng{{$i}} = {lat: parseFloat({{$op->lat}}), lng: parseFloat({{$op->lng}})};
                    var marker{{$i}} = new google.maps.Marker({
                        position: OpLatLng{{$i}},
                        map: map,
                        icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld={{$i}}|ff1100|ffffff',
                    });
                    var contentString{{$i}} = '<div id="content" style="min-width: 320px">'+
                            '<div id="siteNotice">'+
                            '</div>'+'<div class="map-tooltip">'+
                            '<div class="oppor-logo">'+
                            '<img alt="image" class="img-circle" <?php if($op->logo_img == NULL){ ?>src="<?=asset('img/logo/opportunity-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$op->logo_img}} <?php }?>">'+
                            '</div>'+
                            '<div class="oppor-content">'+
                            '<small class="pull-right text-muted"> {{$op->start_date}}</small>'+
                            '<a href="{{url('/volunteer/view_opportunity')}}/{{$op->id}}"><h2>{{$op->title}}<h2></a>'+
                            '<h3>Opportunity</h3>'+
                            '<div class="small m-t-xs">'+
                            '<p>{{$op->description}}</p>'+
                            '<p class="m-b-none">'+
                            '<i class="fa fa-map-marker"></i> {{$op->street_addr1}},{{$op->city}},{{$op->state}}</p>'+
                            '</div></div></div>';

                    var infowindow{{$i}} = new google.maps.InfoWindow({
                        content: contentString{{$i}}
                    });

                    if(op_id == parseInt({{$op->id}})){
                        infowindow{{$i}}.open(map, marker{{$i}});
                    }
                    marker{{$i}}.addListener('click', function() {
                        infowindow{{$i}}.open(map, marker{{$i}});
                    });
                    @endforeach
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        $('#search_address').on('click',function () {
            $(this).hide();
            $('.loc_box').show();
            $('#input_search_loc').val($(this).text());
        })
        // When the window has finished loading google map
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Options for Google map
            // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var myLatLng = {lat: parseFloat({{$search_addr['lat']}}),lng: parseFloat({{$search_addr['lng']}})}
            var mapOptions = {
                zoom: 16,
                center: myLatLng,
                // Style for Google Maps
                styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
            };
            // Get all html elements for map
            var mapElement = document.getElementById('map');
            // Create the Google Map using elements
            var map = new google.maps.Map(mapElement, mapOptions);

                    <?php $i=0; ?>
                    @foreach($opprs as $op)
                    <?php $i++; ?>
            var OpLatLng{{$i}} = {lat: parseFloat({{$op->lat}}), lng: parseFloat({{$op->lng}})}
            var marker{{$i}} = new google.maps.Marker({
                position: OpLatLng{{$i}},
                map: map,
                icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld={{$i}}|ff1100|ffffff',
            });
            var contentString{{$i}} = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+'<div class="map-tooltip">'+
                    '<div class="oppor-logo">'+
                    '<img alt="image" class="img-circle" <?php if($op->logo_img == NULL){ ?>src="<?=asset('img/logo/opportunity-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$op->logo_img}} <?php }?>">'+
                    '</div>'+
                    '<div class="oppor-content">'+
                    '<small class="pull-right text-muted"> {{$op->start_date}}</small>'+
                    '<a href="{{url('/volunteer/view_opportunity')}}/{{$op->id}}"><h2>{{$op->title}}<h2></a>'+
                    '<h3>Opportunity</h3>'+
                    '<div class="small m-t-xs">'+
                    '<p>{{$op->description}}</p>'+
                    '<p class="m-b-none">'+
                    '<i class="fa fa-map-marker"></i> {{$op->street_addr1}},{{$op->city}},{{$op->state}}</p>'+
                    '</div></div></div>';

            var infowindow{{$i}} = new google.maps.InfoWindow({
                content: contentString{{$i}}
            });
            marker{{$i}}.addListener('click', function() {
                infowindow{{$i}}.open(map, marker{{$i}});
            });
            @endforeach

        }
        var selector = '.explore-sidebar li';

        $(selector).on('click', function(){
            $(selector).removeClass('active');
            $(this).addClass('active');
        });

        $(document).on('click.bs.dropdown.data-api', '.dropdown', function (e) {
            e.stopPropagation();
        });

        $('#date-selector .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $(document).ready(function () {
            $('#input_search_loc').val($('#search_address').text());
            $('.opp-search-selectall').click(function() {
                if ($(this).is(':checked')) {
                    $('#opp-checkbox input').attr('checked', true);
                } else {
                    $('#opp-checkbox input').attr('checked', false);
                }
            });
        });
    </script>
@endsection
