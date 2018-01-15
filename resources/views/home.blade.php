@extends('layout.master')

@section('css')
@endsection

@section('content')
    <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
            <li data-target="#inSlider" data-slide-to="1"></li>
            <li data-target="#inSlider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <div class="carousel-caption blank">
                        <h1>Connecting good people with good causes to make</br> a good impact around the world.</h1>
                        <p>My ​Voluntier matches people and organizations together to create positive
                            impacts in their community,</br>while tracking service hours, projects and generating impact reports</p>
                        <p><a class="btn btn-lg btn-primary" href="{{url('/')}}/features" role="button">LEARN MORE</a></p>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back one"></div>

            </div>
            <div class="item">
                <div class="container">
                    <div class="carousel-caption blank">
                        <h1>Connecting good people with good causes to make</br> a good impact around the world.</h1>
                        <p>My ​Voluntier matches people and organizations together to create positive
                            impacts in their community,</br>while tracking service hours, projects and generating impact reports</p>
                        <p><a class="btn btn-lg btn-primary" href="{{url('/')}}/features" role="button">LEARN MORE</a></p>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back two"></div>
            </div>
            <div class="item">
                <div class="container">
                    <div class="carousel-caption blank">
                        <h1>Connecting good people with good causes to make</br> a good impact around the world.</h1>
                        <p>My ​Voluntier matches people and organizations together to create positive
                            impacts in their community,</br>while tracking service hours, projects and generating impact reports</p>
                        <p><a class="btn btn-lg btn-primary" href="{{url('/')}}/features" role="button">LEARN MORE</a></p>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back three"></div>
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

    <section  class="container features">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Our philosophy</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center wow fadeInLeft">
                <div>
                    <h2>Our philosophy is that everyone should have the chance to impact our community. <br/>
                        This is why My Voluntier offers a variety of options for those who have a heart to serve. <br/>It’s why we make it easy for volunteers, organizations and institutions to connect with causes they care about--we call that a Double Positive.<br/>
                        <br/>My Voluntier was created for three kinds of service members:</h2>
                </div>
            </div>
        </div>
    </section>

    <section id="" class="container services">
        <div class="row">
            <div class="col-sm-4  text-center wow fadeInLeft">
                <div>
                    <img alt="image" id="img_volunteer" class="img-circle" src="<?=asset('img/logo/member-default-logo.png')?>" style="width: 80px;">
                    <h2>Volunteer</h2>
                    <div id = "volunteer_detail" class="text-left" style="margin-left: 30px">
                        <p>1.Set up your My Voluntier Account </p>
                        <p>2.Search for Opportunities based on your interests and location</p>
                        <p>3.Track your hours, and see the impact you have had on the community </p>
                    </div>
                    <input type="hidden" id="input_volunteer_detail" value="0">
                    <p><a class="navy-link" id="btn_volunteer_detail" role="button">Details &raquo;</a></p>
                </div>
            </div>
            <div class="col-sm-4  text-center wow fadeInLeft">
                <div>
                    <img alt="image" id="img_organization" class="img-circle" src="<?=asset('img/logo/organization-default-logo.png')?>" style="width: 80px;">
                    <h2>Organization</h2>
                    <div id = "organization_detail" class="text-left" style="margin-left: 30px">
                        <p>1. Set up your Organization Account </p>
                        <p>2. Post New Opportunities </p>
                        <p>3. Receive and manage service volunteers</p>
                        <p>4. Verify the completion of service hours from a single dashboard in My Voluntier</p>
                    </div>
                    <input type="hidden" id="input_organization_detail" value="0">
                    <p><a class="navy-link" id="btn_organization_detail" role="button">Details &raquo;</a></p>
                </div>
            </div>
            <div class="col-sm-4  text-center wow fadeInLeft">
                <div>
                    <img alt="image" id="img_institute" class="img-circle" src="<?=asset('img/logo/community-default-logo.png')?>" style="width: 80px;">
                    <h2>Institution</h2>
                    <div id = "institute_detail" class="text-left" style="margin-left: 30px">
                        <p>1. Set Up Your Institution’s Account</p>
                        <p>2. Invite students to sign up for My Voluntier</p>
                        <p>3. My Voluntier finds the opportunities, and tracks your institution’s time towards serving the community</p>
                    </div>
                    <input type="hidden" id="input_institute_detail">
                    <p><a class="navy-link" id="btn_institute_detail" role="button">Details &raquo;</a></p>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="gray-section team">
        <div class="container features">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>What is My Voluntier? </h1>
                    <h2>My Voluntier is the premiere web application used to find, track, and mobilize individuals to better impact their communities.<br/>
                        Through our state-of-the-art reporting and tracking tools, we provide a suite of powerful assets that allow individuals, groups, and organizations to measure the impact of their service across their community. </h2>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team">
        <div class="container features">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>The Trust Factor </h1>
                    <h2>My Voluntier’s focus has always been on the people--which is why we have become a trusted name to a growing list of organizations for tracking community engagement, service hours and service-learning across the country.</h2>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="gray-section team">
        <div class="container features">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>My Voluntier’s Big Picture</h1>
                    <h2>At My Voluntier, we believe that a better world is possible, when you can connect people who serve with causes they care about.<br/>
                        My Voluntier was created to be a virtual hub for the service community to connect and mobilize to be a driving force for positive change in our communities.
                        <strong>Our goal?</strong> To take away barriers between volunteers and organizations and bring the focus back to what matters: the people.</h2>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team">
        <div class="container features">
            <div class="row m-b-lg" style="margin-top: 50px">
                <div class="col-lg-12 text-center">
                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#signup_dig">Create My Voluntier Account</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#volunteer_detail').hide();
        $('#organization_detail').hide();
        $('#institute_detail').hide();
    })

    $('#btn_volunteer_detail').on('click',function () {
        if($('#input_volunteer_detail').val() == 0)
        {
            $('#volunteer_detail').show();
            $('#input_volunteer_detail').val(1);
        }else{
            $('#volunteer_detail').hide();
            $('#input_volunteer_detail').val(0);
        }
    })

    $('#btn_organization_detail').on('click',function () {
        if($('#input_organization_detail').val() == 0)
        {
            $('#organization_detail').show();
            $('#input_organization_detail').val(1);
        }else{
            $('#organization_detail').hide();
            $('#input_organization_detail').val(0);
        }
    })

    $('#btn_institute_detail').on('click',function () {
        if($('#input_institute_detail').val() == 0)
        {
            $('#institute_detail').show();
            $('#input_institute_detail').val(1);
        }else{
            $('#institute_detail').hide();
            $('#input_institute_detail').val(0);
        }
    });
    
    $('#img_volunteer').on('click',function () {
        $('select[name=account] option[value="Volunteer"]').attr("selected",true);
        $('.reg-first').hide();
        $('#btn_next').hide();
        $('#btn_prev').show();
        $('#btn_regs').show();
        $('.reg-second').show();
        $('.reg-third').hide();
        $('#signup_dig').modal('toggle');
    });
    
    $('#img_organization').on('click',function () {
        $('select[name=account] option[value="Organization"]').attr("selected",true);
        $('.reg-first').hide();
        $('#btn_next').hide();
        $('#btn_prev').show();
        $('#btn_regs').show();

        $('.reg-second').hide();
        $('.reg-third').show();
        $('#signup_dig').modal('toggle');
    });
    
    $('#img_institute').on('click',function () {

    })
</script>
@endsection

