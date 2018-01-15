@extends('layout.master')

@section('css')
@endsection

@section('content')
    <div id="top_image" style="height: 470px; background: url('../public/img/landing/pricing.jpg') 50% 0 no-repeat">
    </div>

    <section id="pricing" class="features">
        <div class="container" style="padding-bottom: 50px;">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Pricing</h1>
                    <h2>Get Started with My Voluntier for Free Today!<br/><br/>Interested in finding local opportunities or want to post about your <br/>organization’s needs to local volunteers?<br/> Create a free profile with us!
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 wow zoomIn">
                    <ul class="pricing-plan list-unstyled">
                        <li class="pricing-title">
                            Free Account
                        </li>
                        <li class="pricing-desc">
                            Begin logging service hours from the moment you sign up! Look for your favorite organization’s profile or begin posting about new opportunities with your organization to help people serve.
                        </li>
                        <li class="pricing-price">

                        </li>
                        <li>
                            <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#signup_dig">Create Account</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 wow zoomIn">
                    <ul class="pricing-plan list-unstyled">
                        <li class="pricing-title">
                            Learn how our Web App Can Benefit Your Organization
                        </li>
                        <li class="pricing-desc">
                            Are you interested in utilizing the power of a digital platform to impact not only your community, but your organization as well? Have the power to manage and track volunteers with ease, validate hours, and generate service reports for your community. The My Voluntier Community web app takes management and reporting of service impact to a whole new level.
                            <br/><br/>Pricing starts at $77 per year for small organizations
                        </li>
                        <li>

                        </li>
                        <li>
                            <a class="btn btn-primary btn-xs" href="{{url('/')}}/request">Request a Quote</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team" style="border-top: 1px solid #f4f4f4">
        <div class="container features">
            <div class="row m-b-lg" style="margin-top: 50px">
                <div class="col-lg-12 text-center">
                    <a href="{{url('/')}}/request" class="btn btn-primary">Request a Demo</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection

