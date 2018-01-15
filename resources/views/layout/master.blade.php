<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-quiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=asset('img/logo/logo.png')?>" type="image/x-icon">
    <title>My Voluntier</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=asset('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="<?=asset('css/animate.css')?>" rel="stylesheet">
    <link href="<?=asset('font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=asset('css/style.css')?>" rel="stylesheet">
    <style>
        .datepicker {
            z-index: 10500 !important; /* has to be larger than 1050 */
        }
    </style>
    @yield('css')
</head>
<body id="page-top" class="landing-page">
<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="page-scroll" href="{{url('/')}}">
                    <img alt="image" class="top-logo" src="<?=asset('img/logo/mvlogo.png')?>">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav landing-nav">
                    <li @if($page == 'home') class="active" @endif><a class="page-scroll" href="{{url('/')}}">Home</a></li>
                    <li @if($page == 'features')class="active" @endif><a class="page-scroll" href="{{url('/')}}/features">Features</a></li>
                    <li @if($page == 'pricing') class="active" @endif><a class="page-scroll" href="{{url('/')}}/pricing">Pricing</a></li>
                    <li @if($page == 'request') class="active" @endif><a class="page-scroll" href="{{url('/')}}/request">Request A Demo</a></li>
                </ul>
                <div class="nav navbar-right sign-in">
                    @if(!Auth::check())
                        <a class="page-scroll" href="#" data-toggle="modal" id="btn_sing_up" data-target="#signup_dig"><i class="fa fa-user"></i> Sign Up</a>
                        <div class="modal inmodal" id="signup_dig" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated flipInY">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Sign Up</h4>
                                        <h3>Welcome to MyVoluntier!</h3>
                                        <small class="font-bold">Already have an account? <a href="#login_dig" data-toggle="modal" data-dismiss="modal"><i class="fa fa-sign-in"></i> Log In</a></small>
                                    </div>
                                    {{--<form id="register" role="form" method="post" action="{{url('/api/regist_user')}}">--}}
                                    {{--{{ csrf_field() }}--}}
                                    <div class="modal-body">
                                        <div class="reg-first col-md-12">
                                            <p><strong>Please Select User Type</strong></p>
                                            <select class="form-control m-b" name="account">
                                                <option>Volunteer</option>
                                                <option>Organization</option>
                                            </select>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <div class="reg-second">
                                            <div class="col-md-12 reg-content">
                                                <p><strong>User Name: </strong></p>
                                                <input type="text" name="v_username" id="v_user_name" class="form-control name-panel">
                                                <input type="hidden" id="is_invalid_o_user" value="1">
                                                <p class="p_invalid" id="v_invalid_username_alert">Already in use. Please enter another.</p>
                                            </div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>First Name: </strong></p>
                                                <input type="text" name="first_name" id="first_name" class="form-control name-panel">
                                            </div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Last Name: </strong></p>
                                                <input type="text" name="last_name" id="last_name" class="form-control name-panel">
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Gender: </strong></p>
                                                <label><input type="radio" checked="" value="male" id="optionsRadios1" name="sex"> Male</label> &emsp;
                                                <label> <input type="radio" value="female" id="optionsRadios2" name="sex"> Female</label>
                                            </div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Zip Code: </strong></p>
                                                <input type="text" name="v_zipcode" id="v_zipcode" class="form-control name-panel" placeholder="Enter Zipcode">
                                                <p class="p_invalid" id="v_invalid_zipcode_alert">Invalid Zip Code. Please enter again</p>
                                                <p class="p_invalid" id="v_location_zipcode_alert">We can't get location from this zip code!</p>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-12 reg-content">
                                                <p><strong>Birthdate: </strong></p>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="birth_day" id="birth_day" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Email: </strong></p>
                                                <input type="text" name="v_email" id="v_email" class="form-control name-panel" placeholder="Enter email">
                                                <p class="p_invalid" id="v_invalid_email_alert">Invalid Email Address</p>
                                                <p class="p_invalid" id="v_existing_email_alert">Existing Email Address</p>
                                            </div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Contact Number: </strong></p>
                                                <input type="text" name="v_contact_num" id="v_contact_num" class="form-control name-panel" placeholder="Enter Contact Number">
                                                <p class="p_invalid" id="v_invalid_contact_number">Invalid Contact Number</p>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Password: </strong></p>
                                                <input type="password" name="v_password" id="v_password" class="form-control name-panel" placeholder="Enter password">
                                                <p class="p_invalid" id="v_invalid_password">Please enter more than 6 letters</p>
                                            </div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Confirm Password: </strong></p>
                                                <input type="password" name="v_confirm" id="v_confirm" class="form-control name-panel" placeholder="Confirm password">
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-12 reg-content">
                                                <label> <input type="checkbox" id="verify_aga" class="i-checks"> I am older than 13 years old </label>
                                                <p class="p_invalid" id="verify_age_alert" style="display: none;">Please verify your age</p>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-12 reg-content">
                                                <label> <input type="checkbox" id="v_accept_terms" class="i-checks"> I accept the  <a href="#terms_conditions" data-toggle="modal" data-dismiss="modal">Terms and Conditions</a></label>
                                                <p class="p_invalid" id="v_terms_alert" style="display:none;">You need accept our terms and conditions to register</p>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                                        <div class="reg-select-org col-md-12">
                                            <p><strong>Please Select Organization Type: </strong></p>
                                            <select name="org_type" class="form-control m-b" id="org_type">
                                                @foreach($org_type_names as $org_name)
                                                    <option value="{{$org_name->id}}">{{$org_name->organization_type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <div class="reg-third">
                                            <div class="col-md-12 reg-content">
                                                <p><strong>User Name: </strong></p>
                                                <input type="text" name="o_user_name" id="o_user_name" class="form-control name-panel">
                                                <p class="p_invalid" id="o_invalid_username_alert">Already in use. Please enter another.</p>
                                            </div>
                                            <div class="col-md-12 reg-content">
                                                <p><strong id="p_org_name">Organization Name: </strong></p>
                                                <input type="text" name="org_name" id="org_name" class="form-control name-panel">
                                            </div>
                                            <div class="col-md-12 reg-content school-type">
                                                <p><strong>School Type: </strong></p>
                                                <select name="school_type" class="form-control m-b" id="school_type">
                                                    @foreach($school_type as $s)
                                                        <option value="{{$s->id}}">{{$s->school_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 reg-content non-org-type" style="display: none">
                                                <p><strong>Organization Type: </strong></p>
                                                <input type="text" name="non_org_type" id="non_org_type" class="form-control name-panel">
                                            </div>
                                            <div class="col-md-12 reg-content ein-field" style="display: none">
                                                <p><strong>EIN: </strong></p>
                                                <input type="text" name="org_ein" id="org_ein" class="form-control name-panel">
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div style="clear: both"></div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Date Founded: </strong></p>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="found_day" id="found_day" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Zip Code: </strong></p>
                                                <input type="text" name="o_zipcode" id="o_zipcode" class="form-control name-panel" placeholder="Enter Zipcode">
                                                <p class="p_invalid" id="o_invalid_zipcode_alert">Invalid Zip code. Please enter again</p>
                                                <p class="p_invalid" id="o_location_zipcode_alert">We can't get location from this zip code!</p>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Email: </strong></p>
                                                <input type="text" name="o_email" id="o_email" class="form-control name-panel" placeholder="Enter Email address">
                                                <p class="p_invalid" id="o_invalid_email_alert">Invalid Email Address.</p>
                                                <p class="p_invalid" id="o_existing_email_alert">Existing Email Address</p>
                                            </div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Contact Number: </strong></p>
                                                <input type="text" name="o_contact_num" id="o_contact_num" class="form-control name-panel" placeholder="Enter Contact Number">
                                                <p class="p_invalid" id="o_invalid_contact_number">Invalid Contact Number</p>
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Password: </strong></p>
                                                <input type="password" name="o_password" id="o_password" class="form-control name-panel" placeholder="Enter password">
                                                <p class="p_invalid" id="o_invalid_password">Enter more than 6 letters</p>
                                            </div>
                                            <div class="col-md-6 reg-content">
                                                <p><strong>Confirm Password: </strong></p>
                                                <input type="password" name="o_confirm" id="o_confirm" class="form-control name-panel" placeholder="Confirm password">
                                            </div>
                                            <div style="clear: both;"></div>
                                            <div class="col-md-12 reg-content">
                                                <label> <input type="checkbox" id="o_accept_terms" class="i-checks"> I accept the  <a href="#terms_conditions" data-toggle="modal" data-dismiss="modal">Terms and Conditions</a></label>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                                        <div class="reg-forth col-md-12" style="text-align:center; display: none">
                                            <h3><strong>Thanks for your registration</strong></h3>
                                            <p>We sent verification email to you. Please confirm to login</p>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="modal-footer">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" id="btn_prev" style="display:none;">Previous</button>
                                            <button type="button" class="btn btn-primary" id="btn_next">Next</button>
                                            <button type="button" class="btn btn-primary" id="btn_regs" style="display:none;">Register</button>
                                            <button type="button" class="btn btn-primary close" data-dismiss="modal" id="btn_ok" style="display: none; opacity: 1;">OK</button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="level" value="0">
                                    {{--</form>--}}
                                </div>
                            </div>
                        </div>
                        <a class="page-scroll" href="#" data-toggle="modal" data-target="#login_dig"><i class="fa fa-sign-in"></i> Log In</a>
                        <div class="modal inmodal" id="login_dig" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated flipInY">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Log In</h4>
                                        <h3>Welcome back to MyVoluntier!</h3>
                                        <small class="font-bold">New to MyVoluntier? <a href="#signup_dig" data-toggle="modal" data-dismiss="modal"><i class="fa fa-user"></i> Sign Up</a></small>
                                    </div>
                                    {{--<form id="login" role="form" method="post" action="{{url('api/login_user')}}">--}}
                                    {{--{{ csrf_field() }}--}}
                                    <div class="modal-body login-first">
                                        <div class="col-md-12 reg-content">
                                            <p><strong>User Name: </strong></p>
                                            <input type="text" name="username" id="login_user" class="form-control" placeholder="Enter User Name" autocomplete="off"/>
                                            <a href="#forgot_user_dig" data-toggle="modal" data-dismiss="modal">Forgot UserName</a>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <div class="col-md-12 reg-content">
                                            <p><strong>Password: </strong></p>
                                            <input type="password" name="password" id="login_password" class="form-control" placeholder="Enter Your Password" autocomplete="off"/>
                                            <a href="#forgot_password_dig" data-toggle="modal" data-dismiss="modal">Forgot Password</a>
                                            <p class="p_invalid" id="password_not_match">Invalid Username or password. Please enter again.</p>
                                            <p class="p_invalid" id="confirm_not_match">Please confirm your account before login.</p>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="modal-footer">
                                        <div class="col-md-12">
                                            <button type="submit" id="btn_login" class="btn btn-primary">Log In</button>
                                        </div>
                                    </div>
                                    {{--</form>--}}
                                </div>
                            </div>
                        </div>
                        <div class="modal inmodal" id="forgot_user_dig" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated flipInY">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Forgot Username?</h4>
                                        <h3>Please insert your email address and click submit!</h3>
                                    </div>
                                    <div class="modal-body login-first">
                                        <div class="col-md-12 reg-content forgot_user_form">
                                            <p><strong>Email: </strong></p>
                                            <input type="text" id="get_user_email" class="form-control" placeholder="Enter Your Email Address">
                                            <p class="p_invalid" id="forgot_user_invalid_email">Invalid Email Address. Email Address does not exist.</p>
                                        </div>
                                        <div class="col-md-12 reg-content forgot_user_success">
                                            <h3>We sent your Username via email. Please check your email!</h3>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="modal-footer">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary close" data-dismiss="modal" id="forgot_user_close" style="display: none; opacity: 1;">Close</button>
                                            <button type="button" id="forgot_user" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal inmodal" id="forgot_password_dig" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated flipInY">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Forgot Password?</h4>
                                        <h3>We will give you link to reset password via email!</h3>
                                    </div>
                                    <div class="modal-body login-first">
                                        <div class="col-md-12 reg-content forgot_password_form">
                                            <p><strong>Email: </strong></p>
                                            <input type="text" id="get_password_email" class="form-control" placeholder="Enter Your Email Address">
                                            <p class="p_invalid" id="forgot_password_invalid_email">Invalid Email Address. Email Address does not exist.</p>
                                        </div>
                                        <div class="col-md-12 reg-content forgot_password_success">
                                            <h3>We sent your Link via email. Please check your email!</h3>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="modal-footer">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary close" data-dismiss="modal" id="forgot_password_close" style="display: none; opacity: 1;">Close</button>
                                            <button type="button" id="forgot_password" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal inmodal" id="terms_conditions" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated flipInY">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Terms and Conditions</h4>
                                        <h3>Please read our terms and conditions carefully and agree with us!</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12 reg-content">
                                            <p>
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                                Here is content of Terms and conditions
                                            </p>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="modal-footer">
                                        <div class="col-md-12">
                                            <a href="#signup_dig" data-toggle="modal" data-dismiss="modal" class="btn btn-primary close" data-dismiss="modal" id="btn_agree" style="opacity: 1;">I Agree</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a class="page-scroll" href="{{url('signout_user')}}"><i class="fa fa-sign-out"></i> Log Out</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
@yield('content')
<section id="contact" class="gray-section" style="margin-top: 0; padding-top: 20px">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="m-t-sm">
                    Or follow us on social platform
                </p>
                <ul class="list-inline social-icon" style="margin-top: 10px">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p class="landing-copy-right"></p>
            </div>
        </div>
    </div>
</section>

<!-- Mainly scripts -->
<script src="<?=asset('js/jquery-2.1.1.js')?>"></script>
<script src="<?=asset('js/bootstrap.min.js')?>"></script>
<script src="<?=asset('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
<script src="<?=asset('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
<script src="<?=asset('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>

<!-- Custom and plugin javascript -->
<script src="<?=asset('js/inspinia.js')?>"></script>
<script src="<?=asset('js/plugins/pace/pace.min.js')?>"></script>
<script src="<?=asset('js/plugins/wow/wow.min.js')?>"></script>
<script src="<?=asset('js/plugins/overlay/loadingoverlay.min.js')?>"></script>
<script src="<?=asset('js/check_validate.js')?>"></script>
<script src="<?=asset('js/global.js')?>"></script>
<script src="<?=asset('js/home-action.js')?>"></script>

<script>
    $(document).ready(function (){
        var d = new Date();
        var n = d.getFullYear();
        $('.landing-copy-right').html('<strong>&copy; '+n+' My Voluntier, LCC</strong>');
    });
</script>
@yield('script')

</body>
</html>
