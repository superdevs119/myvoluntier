@extends('volunteer.layout.master')
@section('css')
    <link href="<?=asset('css/star-rating.min.css')?>" rel="stylesheet">
@endsection

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel" style="margin-top: 0">
                    <div class="impact-tracked-hours">
                        <div class="col-md-5">
                            <div class="track-logo">
                                <img src="<?=asset('img/logo/time_tracker.png')?>">
                            </div>
                            <div class="tracked-hours">
                                <h2>Your Total Tracked Hours:</h2>
                                <h1>{{$logged_mins}}</h1><h3>Hours</h3>
                            </div>
                            <div class="friend-ranking">
                                <h2>Your Ranking Among Your Friends:</h2><h1 id="my_ranking"></h1>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div id="friend-graph"></div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="divider"></div>
                    <div class="impact-ranking-panel">
                        <h1>Ranking & Tracked Hours on Organizations</h1>
                        <div class="col-md-5">
                            <div class="org-ranking">
                                <h2>Your Ranking Among Organizations</h2>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Organizations</th>
                                        <th>Your Rank</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($org_ranking as $ranking)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$ranking['org_name']}}</td>
                                        <td>{{$ranking['my_ranking']}}</td>
                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="impact-pie-chart" class="impact-chart-orgs col-md-7"></div>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="divider"></div>
                    <div class="impact-timecard">
                        <h1>Performance Awards for {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h1>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Opportunity</th>
                                <th>Submission Date</th>
                                <th>Tracked Hours</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 1; ?>
                            @foreach($opp_hours as $oh)
                            <tr>
                                <td>{{$j}}</td>
                                <td>{{$oh->opp_name}}</td>
                                <td>{{$oh->submitted_date}}</td>
                                <td>{{floatval($oh->logged_hours)}}</td>
                            </tr>
                            <?php $j++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div class="impact-review">
                        <h1>Comments & Reviews</h1>
                        @foreach($reviews as $r)
                        <?php $date = explode(' ',$r->updated_at); $updated_at = date('F j, Y',strtotime($date[0])); ?>
                        <div class="review-panel">
                            <div class="review-image">
                                @if($r->org_logo == null)
                                    <img alt="image" class="img-circle" src="<?=asset('img/logo/organization-default-logo.png')?>">
                                @else
                                    <img alt="image" class="img-circle" src="<?=asset('uploads')?>/{{$r->org_logo}}">
                                @endif
                            </div>
                            <div class="review-text">
                                <a href="{{url('/profile')}}/{{$r->review_from}}" target="_blank"><h3>{{$r->org_name}}</h3></a>
                                <div class="rating-stars"><input name="input-1" class="rating-loading org-rate" data-min="0" data-max="5" data-step="0.1" data-size="xs" value="{{$r->mark}}"></div>
                                <h5> ({{$updated_at}})</h5>
                                <p>{{$r->comment}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="impact-ranking-panel">
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
<script src="<?=asset('js/star-rating.min.js')?>"></script>
<script>
    $(document).on('ready', function(){
        $('.org-rate').rating({displayOnly: true});
        viewFriendGraph();
    });

    function viewFriendGraph() {
        var url = API_URL + 'volunteer/impact/getFriendInfo';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log();
        var type = "post";
        $.ajax({
            type: type,
            url: url,
            success: function (data) {
                var friend_chart = Highcharts.chart('friend-graph', {

                    title: {
                        text: 'Tracked Hours of Your friends'
                    },

                    xAxis: {
                        categories: data.friend_name
                    },

                    series: [{
                        name: 'Tracked Hours',
                        type: 'column',
                        colorByPoint: true,
                        data: data.logged_hours,
                        showInLegend: false
                    }]

                });
                $('#my_ranking').html(data.rank);

                var org_chart = Highcharts.chart('impact-pie-chart', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 65
                        }
                    },
                    title: {
                        text: 'Tracked Hours by Organizations'
                    },
                    plotOptions: {
                        pie: {
                            innerSize: 100,
                            depth: 45
                        }
                    },
                    series: [{
                        name: 'Tracked Hours',
                        data: data.org_hours
                    }]
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

</script>
@endsection