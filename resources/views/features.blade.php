@extends('layout.master')

@section('css')
@endsection

@section('content')
    <div id="top_image" style="height: 470px; background: url('../public/img/landing/features.jpg') 50% 0 no-repeat">
        <div class="container">
            <div style="padding: 200px 0; color: #fff; text-align: center">
                <h1 style=" font-size: 35px">The ultimate tool for institutions, organizations, and individuals wanting to make a positive impact in their community.</h1>
            </div>
        </div>
    </div>

    <section class="features">
        <div class="container"  style="padding-bottom: 50px;">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>My Voluntier creates a bridge between impassioned people and causes in their community</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 features-text">
                    <h2>Communicate with all your volunteers in one central location </h2>
                    <p>Our geo-targeting location web application empowers you to discover and connect with people around your community quickly and easily. Volunteers are able to subscribe to your organization’s profile-- receiving news, opportunities, and resources from approved admin members. </p>
                </div>
                <div class="col-lg-4 features-text">
                    <h2>Update your Members of the Latest Opportunities </h2>
                    <p>Our Quick Add feature enables partners, members and administrators to add events specifically
                        fo
                        r the My Voluntier community. For institutions, schools and other associations, your profiles
                        turn into Group pages, which allows for volunteers of your organization to receive your updates
                        quickly. Your volunteers will be able to see these new bulletins quickly in their My Voluntier
                        dashboard.</p>
                </div>
                <div class="col-lg-4 features-text">
                    <h2>Search for Opportunities Local to Your Area <br/><br/></h2>
                    <p>When searching for new opportunities, we list the latest and most popular opportunities within
                        your zip code, and our Explore feature places all of your community’s engagement in a single
                        view. Traveling and would still like to serve? You can update your location to see which
                        organizations you can volunteer with nearby!</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>My Voluntier equips both organizations and volunteers with the most comprehensive tracking and reporting features in the service community</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 features-text">
                    <h2>Centralized Hour Tracking  </h2>
                    <p>Say goodbye to long email threads and manual spreadsheets! With our easy-to-use Hour Tracker organizations can view, approve and analyze hours for all their members as they are inputted. This can be for volunteers, service-learning, internships and paying jobs! </p>
                </div>
                <div class="col-lg-6 features-text">
                    <h2>Real Time Impact Measurement </h2>
                    <p>Showcase the impact your members are making onto the community with our real-time Impact tool, which calculates and displays the economic and social impact of your volunteers--further demonstrating how impactful individuals can be when they band together to serve in their communities.</p>
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

