@extends('volunteer.layout.master')

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight profile-panel">
                    <div class="col-lg-8 profile-info">
                        <div class="profile-image">
                            <form id="upload_logo" role="form" method="post" action="{{url('api/volunteer/profile/upload_logo')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="profile-image-hover">
                                    <img <?php if(Auth::user()->logo_img == NULL){ ?>src="<?=asset('img/logo/member-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{Auth::user()->logo_img}}" <?php }?> class="img-circle circle-border m-b-md" alt="profile">
                                    <label title="Upload image file" for="inputImage" class="btn btn-default">
                                        <input type="file" accept="image/*" name="file_logo" id="inputImage" class="hide">Change Photo
                                    </label>
                                </div>
                            </form>
                            <p><a href="{{url('/volunteer/accountSetting')}}"><i class="fa fa-user"></i>  My Account >></a></p>
                        </div>
                        <?php
                            $this_year = date("Y");
                            $this_month = date("m");
                            $birth_year = explode("/", Auth::user()->birth_date);
                            if(((int)$this_month - (int)$birth_year[0]) >= 0){
                                $age = $this_year - $birth_year[2];
                            }else{
                                $age = $this_year - $birth_year[2]-1;
                            }
                        ?>
                        <div class="profile-text">
                            <h1 class="no-margins"><strong>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</strong></h1></br>
                            <div class="col-sm-12">
                                <h4 class="col-sm-4">E-Mail:</h4>
                                <h4 class="col-sm-8">{{Auth::user()->email}}</h4>
                                <h4 class="col-sm-4">User ID:</h4>
                                <h4 class="col-sm-8">{{Auth::user()->user_name}}</h4>
                                <h4 class="col-sm-4">Age:</h4>
                                <h4 class="col-sm-8">{{$age}}</h4>
                                <h4 class="col-sm-4">Location:</h4>
                                <h4 class="col-sm-8">{{Auth::user()->city}}, {{Auth::user()->state}}, {{Auth::user()->country}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 profile-slider">
                        <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#inSlider" data-slide-to="0" class="active"></li>
                                <li data-target="#inSlider" data-slide-to="1"></li>
                                <li data-target="#inSlider" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="carousel-caption">
                                        <p><a class="btn btn-lg btn-danger" href="{{url('/volunteer/single_track')}}" role="button">Add Hours</a>
                                        </p>
                                    </div>
                                    <div class="carousel-image wow zoomIn">
                                        <img src="<?=asset('img/slide/add_hours.png') ?>"/>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carousel-caption">
                                        <p><a class="btn btn-lg btn-danger" href="{{url('/volunteer/opportunity')}}" role="button">Opportunities</a>
                                        </p>
                                    </div>
                                    <div class="carousel-image wow zoomIn">
                                        <img src="<?=asset('img/slide/globe.png') ?>"/>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carousel-caption">
                                        <h2>Tracked Hours</h2>
                                        <h1>{{$logged_hours}}</h1>
                                        <h2>Regional Ranking</h2>
                                        <h1>{{$regional_ranking}}</h1>
                                    </div>
                                    <div class="carousel-image wow zoomIn">
                                        <img src="<?=asset('img/slide/rank_hours.png') ?>"/>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 animated fadeInRight impact-panel">
                    <div class="news-feed">
                        <div class="col-md-7">
                            <h2>News Feeds</h2>
                            <ul class="list-group clear-listm-t">
                                <a href=""><li class="list-group-item first-item">
                                        <span class="pull-right">Nov 15,2017 09:00 pm</span>
                                        <span class="label label-success"><i class="fa fa-check"></i></span> 4 hours approved by Jack Queen on KaKaosBook
                                    </li></a>
                                <a href=""><li class="list-group-item ">
                                        <span class="pull-right">Nov 17,2017 09:00 pm</span>
                                        <span class="label label-success"><i class="fa fa-check"></i></span> 6 hours approved by Jack Queen on KaKaosBook
                                    </li></a>
                                <a href=""><li class="list-group-item">
                                        <span class="pull-right">Nov 15,2017 09:00 pm</span>
                                        <span class="label label-warning"><i class="fa fa-reply"></i></span> You submitted 5 hours on HappyPPEES
                                    </li></a>
                                <a href=""><li class="list-group-item">
                                        <span class="pull-right">Nov 15,2017 09:00 pm</span>
                                        <span class="label label-danger"><i class="fa fa-exclamation-triangle"></i></span> You submitted 5 hours on HappyPPEES declined.
                                    </li></a>
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <h2>Followed Orgs/Groups</h2>
                            <ul class="list-group elements-list">
                                @foreach($follows as $f)
                                    <li class="list-group-item">
                                        <div class="oppor-logo">
                                            @if($f['type']=='organization')
                                                @if($f['logo']==null)
                                                    <img alt="image" class="img-circle" src="<?=asset('img/logo/organization-default-logo.png') ?>">
                                                @else
                                                    <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$f['logo']}}">
                                                @endif
                                            @elseif($f['type']=='group')
                                                @if($f['logo']==null)
                                                    <img alt="image" class="img-circle" src="<?=asset('img/logo/group-default-logo.png') ?>">
                                                @else
                                                    <img alt="image" class="img-circle" src="{{url('/uploads')}}/{{$f['logo']}}">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="oppor-content">
                                            <small class="pull-right text-muted"> {{$f['followed_date']}}</small>
                                            <a @if($f['type']=='organization') href="{{url('/organization/profile')}}/{{$f['id']}}" @else href="{{url('/organization/group/view_group_detail')}}/{{$f['id']}}" @endif><h2>{{$f['name']}}<h2></a>
                                            <h3><i class="fa fa-star"></i> {{$f['type']}} <i class="fa fa-star"></i></h3>
                                            <div class="small m-t-xs">
                                                <h3>Tracked Hours:</h3><h2>{{$f['logged_hours']}}</h2>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            var $image = $(".profile-image-hover > img")

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
    </script>
@endsection