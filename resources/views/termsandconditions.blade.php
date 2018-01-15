@extends('layout.master')

@section('css')
@endsection

@section('content')
    <section class="features" style="padding-top: 150px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Terms and Conditions</h1>
                    <p>Please read our terms and conditions carefully and agree with us. </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 style="text-align: left;">
                        Here Terms and Conditions Contents.....
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                        Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis,
                        totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                    </h3>
                    <br/>
                    <a href="{{url('/')}}" class="btn btn-primary">I Agree</a>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });
        });

        $('#btn_next').on('click',function(){
            $('.reg-first').hide();
            $(this).hide();
            $('#btn_prev').show();
            $('#btn_regs').show();
            if($('select[name=account]').val() == 'Volunteer'){
                $('.reg-second').show();
                $('.reg-third').hide();
            }else{
                $('.reg-second').hide();
                $('.reg-third').show();
            }
        });

        $('#btn_prev').on('click',function(){
            $('.reg-first').show();
            $('.reg-second').hide();
            $('.reg-third').hide();
            $(this).hide();
            $('#btn_regs').hide();
            $('#btn_next').show();
        });

        $('#v_confirm').on('change',function () {
            if($('#v_password').val() != $(this).val()){
                $(this).css("border","1px solid #ff0000");
            }
        });

        $('#o_confirm').on('change',function () {
            if($('#o_password').val() != $(this).val()){
                $(this).css("border","1px solid #ff0000");
            }
        });

        $('#btn_regs').on('click',function(){
            var vol_flags = 0;
            var org_flags = 0;
            if($('select[name=account]').val() == 'Volunteer'){
                if ($("#v_user_name").val() == ''){
                    $("#v_user_name").css("border","1px solid #ff0000");
                    vol_flags++;
                }
                if($('#first_name').val()==''){
                    $('#first_name').css("border","1px solid #ff0000");
                    vol_flags++;
                }
                if($('#last_name').val()=='') {
                    $('#last_name').css("border", "1px solid #ff0000");
                    vol_flags++;
                }
                if($('#birth_day').val()=='') {
                    $('#birth_day').css("border", "1px solid #ff0000");
                    vol_flags++;
                }
                if($('#v_zipcode').val()=='') {
                    $('#v_zipcode').css("border", "1px solid #ff0000");
                    vol_flags++;
                }
                if (!ValidateZipcode($('#v_zipcode').val())) {
                    vol_flags++;
                    $('#v_invalid_zipcode_alert').show();
                }
                if($('#v_email').val()=='') {
                    $('#v_email').css("border", "1px solid #ff0000");
                    vol_flags++;
                }
                if (!ValidateEmail($('#v_email').val())) {
                    vol_flags++;
                    $('#v_invalid_email_alert').show();
                }
                if($('#v_contact_num').val()=='') {
                    $('#v_contact_num').css("border", "1px solid #ff0000");
                    vol_flags++;
                }
                if (!ValidatePhonepumber($('#v_contact_num').val())) {
                    vol_flags++;
                    $('#v_invalid_contact_number').show();
                }
                if($('#v_password').val()=='') {
                    $('#v_password').css("border", "1px solid #ff0000");
                    vol_flags++;
                }
                if (!ValidatePassword($('#v_password').val())) {
                    vol_flags++;
                    $('#v_invalid_password').show();
                }
                if($('#v_confirm').val()=='') {
                    $('#v_confirm').css("border", "1px solid #ff0000");
                    vol_flags++;
                }
                if($("#verify_aga").is(":not(:checked)")){
                    $("#verify_age_alert").show();
                    $("#verify_age_alert").css("color","red");
                    vol_flags++;
                }
                if($("#v_accept_terms").is(":not(:checked)")){
                    $("#v_terms_alert").show();
                    $("#v_terms_alert").css("color","red");
                    vol_flags++;
                }
                if($('#v_password').val() != $('#v_confirm').val()){
                    vol_flags++;
                }
                if(vol_flags == 0){
                    var url = API_URL + 'reg_volunteer';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })

                    console.log();
                    var type = "POST";
                    var formData = {
                        user_name: $("#v_user_name").val(),
                        first_name: $('#first_name').val(),
                        last_name: $('#last_name').val(),
                        birth_day: $('#birth_day').val(),
                        zipcode: $('#v_zipcode').val(),
                        email: $('#v_email').val(),
                        contact_number: $('#v_contact_num').val(),
                        password: $('#v_password').val(),
                        gender: $("input[name='sex']:checked").val(),
                    }
                    $.ajax({
                        type: type,
                        url: url,
                        data: formData,
                        success: function (data) {
                            if(data.result == 'username exist'){
                                $('#v_invalid_username_alert').show();
                                $("#v_user_name").val('');
                            }
                            if(data.result == 'email exist'){
                                $('#v_existing_email_alert').show();
                                $("#v_email").val('');
                            }
                            if(data.result == 'invalid zipcode'){
                                $('#v_location_zipcode_alert').show();
                                $("#v_zipcode").val('');
                            }
                            if(data.result == 'success'){
                                $('.reg-second').hide();
                                $('#btn_prev').hide();
                                $('#btn_regs').hide();
                                $('.reg-forth').show();
                                $('#btn_ok').show();
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            }else {
                if ($("#o_user_name").val() == ''){
                    $("#o_user_name").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if ($("#org_name").val() == ''){
                    $("#org_name").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if ($("#found_day").val() == ''){
                    $("#found_day").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if ($("#o_address").val() == ''){
                    $("#o_address").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if ($("#o_zipcode").val() == ''){
                    $("#o_zipcode").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if (!ValidateZipcode($('#o_zipcode').val())) {
                    org_flags++;
                    $('#o_invalid_zipcode_alert').show();
                }
                if ($("#o_email").val() == ''){
                    $("#o_email").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if (!ValidateEmail($('#o_email').val())) {
                    org_flags++;
                    $('#o_invalid_email_alert').show();
                }
                if ($("#o_contact_num").val() == ''){
                    $("#o_contact_num").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if (!ValidatePhonepumber($('#o_contact_num').val())) {
                    org_flags++;
                    $('#o_invalid_contact_number').show();
                }
                if ($("#o_password").val() == ''){
                    $("#o_password").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if (!ValidatePassword($('#o_password').val())) {
                    org_flags++;
                    $('#o_invalid_password_alert').show();
                }
                if ($("#o_confirm").val() == ''){
                    $("#o_confirm").css("border","1px solid #ff0000");
                    org_flags++;
                }
                if($("#o_accept_terms").is(":not(:checked)")){
                    $("#o_terms_alert").show();
                    $("#o_terms_alert").css("color","red");
                    org_flags++;
                }
                if($('#o_password').val() != $('#o_confirm').val()){
                    org_flags++;
                }
                if(org_flags == 0){
                    var url = API_URL + 'reg_organization';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    console.log();
                    var type = "POST";
                    var formData = {
                        user_name: $("#o_user_name").val(),
                        org_name: $('#org_name').val(),
                        address: $('#o_address').val(),
                        birth_day: $('#found_day').val(),
                        zipcode: $('#o_zipcode').val(),
                        type: $( "#org_type option:selected" ).val(),
                        email: $('#o_email').val(),
                        contact_number: $('#o_contact_num').val(),
                        password: $('#o_password').val(),
                    }
                    $.ajax({
                        type: type,
                        url: url,
                        data: formData,
                        success: function (data) {
                            if(data.result == 'username exist'){
                                $('#o_invalid_username_alert').show();
                                $("#o_user_name").val('');
                            }
                            if(data.result == 'email exist'){
                                $('#o_existing_email_alert').show();
                                $("#o_email").val('');
                            }
                            if(data.result == 'invalid zipcode'){
                                $('#o_location_zipcode_alert').show();
                                $("#o_zipcode").val('');
                            }
                            if(data.result == 'success'){
                                $('.reg-third').hide();
                                $('#btn_prev').hide();
                                $('#btn_regs').hide();
                                $('.reg-forth').show();
                                $('#btn_ok').show();
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            }
        });

        $('#btn_login').on('click',function() {
            if ($("#login_user").val() == '')
                $("#login_user").css("border", "1px solid #ff0000");
            if ($("#login_password").val() == '')
                $("#login_password").css("border", "1px solid #ff0000");
            var url = API_URL + 'login_user';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            console.log();
            var type = "POST";
            var formData = {
                user_id: $("#login_user").val(),
                password: $("#login_password").val(),
            }
            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    if(data.result == 'invalid'){
                        $('#password_not_match').show();
                        $("#login_user").val('');
                        $("#login_password").val('');
                    }
                    if(data.result == 'volunteer'){
                        window.location.replace("{{url('/volunteer')}}");
                    }
                    if(data.result == 'organization'){
                        window.location.replace("{{url('/organization')}}");
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        $("#o_accept_terms").on('click',function () {
            $("#o_terms_alert").hide();
        });

        $("#verify_aga").on('click',function () {
            $("#verify_age_alert").hide();
        });

        $("#v_accept_terms").on('click',function () {
            $("#v_terms_alert").hide();
        });

        $('.form-control').on('click',function () {
            $(this).css("border","1px solid #e5e6e7");
            $(this).parent().find('.p_invalid').hide();
        });

        var cbpAnimatedHeader = (function() {
            var docElem = document.documentElement,
                    header = document.querySelector( '.navbar-default' ),
                    didScroll = false,
                    changeHeaderOn = 200;
            function init() {
                window.addEventListener( 'scroll', function( event ) {
                    if( !didScroll ) {
                        didScroll = true;
                        setTimeout( scrollPage, 250 );
                    }
                }, false );
            }
            function scrollPage() {
                var sy = scrollY();
                if ( sy >= changeHeaderOn ) {
                    $(header).addClass('navbar-scroll')
                }
                else {
                    $(header).removeClass('navbar-scroll')
                }
                didScroll = false;
            }
            function scrollY() {
                return window.pageYOffset || docElem.scrollTop;
            }
            init();

        })();

        // Activate WOW.js plugin for animation on scrol
        new WOW().init();

    </script>
@endsection

