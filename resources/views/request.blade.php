@extends('layout.master')

@section('css')
@endsection

@section('content')
    <div id="top_image" style="height: 470px; background: url('../public/img/landing/request.jpg') 50% 0 no-repeat">
        <div class="container">
            <div style="padding: 200px 0; color: #fff; text-align: center">
                <h1 style=" font-size: 35px">We’ve been there--it’s difficult to find, mobilize and track volunteers</h1>
            </div>
        </div>
    </div>

    <section id="contact" class="gray-section contact features" style="margin-top: 0">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Request a Demo</h1>
                    <p>It’s even harder to measure their impact on the community with outdated, manual processes. As a part of the service community, our goal is to create a solution that makes logging hours, promoting new opportunities, and showcasing your good work as seamless as possible. It’s because of this philosophy that we continually work to make Voluntier the premiere web application for volunteers and organizations in the industry,

                        We would love to show you how Voluntier can play a pivotal role in your organization’s mission to leave a positive mark on your community.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center" id="request_field">
                    <div class="text-left" style="max-width: 800px; margin: auto; padding-bottom: 20px">
                        <div class="col-md-6 reg-content">
                            <p><strong>First Name: </strong></p>
                            <input type="text" name="request_first_name" id="request_first_name" class="form-control name-panel" placeholder="Enter First Name">
                        </div>
                        <div class="col-md-6 reg-content">
                            <p><strong>Last Name: </strong></p>
                            <input type="text" name="request_last_name" id="request_last_name" class="form-control name-panel" placeholder="Enter Last Name">
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-md-12 reg-content">
                            <p><strong>Company/Organization Name: </strong></p>
                            <input type="text" name="request_org_name" id="request_org_name" class="form-control name-panel" placeholder="Enter Company/Organization Name">
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-md-6 reg-content">
                            <p><strong>Email: </strong></p>
                            <input type="text" name="request_email" id="request_email" class="form-control name-panel" placeholder="Enter email">
                            <p class="p_invalid" id="invalid_request_email_alert">Invalid Email Address</p>
                        </div>
                        <div class="col-md-6 reg-content">
                            <p><strong>Phone Number: </strong></p>
                            <input type="text" name="request_phone" id="request_phone" class="form-control name-panel" placeholder="Enter Phone Number">
                            <p class="p_invalid" id="v_invalid_phone_number_alert">Invalid Phone Number. Please enter again</p>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-md-12">
                            <p><strong>I’d like to know more about…</strong></p>
                            <textarea id="more_comment" rows="5" class="form-control"></textarea>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                    <a type="button" id="btn_send_request" class="btn btn-primary">Send Request</a>
                </div>
                <div class="col-lg-12 text-center" id="success_field" style="display: none">
                    <h2>Thanks for your request. Will reply to you sooner!</h2>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('#btn_send_request').on('click',function () {
            var flag = 0;
            var f_name = $('#request_first_name').val();
            if(f_name == ''){
                $('#request_first_name').css("border", "1px solid #ff0000");
                flag++;
            }
            var l_name = $('#request_last_name').val();
            if(l_name == ''){
                $('#request_last_name').css("border", "1px solid #ff0000");
                flag++;
            }
            var org_name = $('#request_org_name').val();
            if(org_name == ''){
                $('#request_org_name').css("border", "1px solid #ff0000");
                flag++;
            }
            var email = $('#request_email').val();
            if(email == ''){
                flag++;
                $('#request_email').css("border", "1px solid #ff0000");
            }
            var phone = $('#request_phone').val();
            if(phone == ''){
                flag++;
                $('#request_phone').css("border", "1px solid #ff0000");
            }
            if (!ValidatePhonepumber($('#request_phone').val())) {
                flag++;
                $('#request_phone').css("border", "1px solid #ff0000");
                $('#v_invalid_phone_number_alert').show();
            }
            if (!ValidateEmail($('#request_email').val())) {
                flag++;
                $('#request_email').css("border", "1px solid #ff0000");
                $('#invalid_request_email_alert').show();
            }
            var comment = $('#more_comment').val();

            if(flag == 0){
                var url = API_URL + 'send_request';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                console.log();
                var type = "post";
                var formData = {
                    first_name: f_name,
                    last_name: l_name,
                    org_name: org_name,
                    email: email,
                    phone: phone,
                    comment: comment,
                };

                $.ajax({
                    type: type,
                    url: url,
                    data: formData,
                    success: function (data) {
                        $('#request_field').hide();
                        $('#success_field').show();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        $('.form-control').on('click',function () {
            $(this).css("border","1px solid #e5e6e7");
            $(this).parent().find('.p_invalid').hide();
        });
    </script>
@endsection

