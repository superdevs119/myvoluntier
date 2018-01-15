@extends('organization.layout.master')

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight profile-panel">
                    <div class="col-lg-12 profile-info">
                        <h1 style="margin: 0 0 30px 0;">My Account Information</h1>
                        <div class="profile-image">
                            <form id="upload_logo" role="form" method="post" action="{{url('api/organization/profile/upload_logo')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="profile-image-hover">
                                    <img <?php if(Auth::user()->logo_img == NULL){ ?>src="<?=asset('img/logo/organization-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{Auth::user()->logo_img}}" <?php }?> class="img-circle circle-border m-b-md" alt="profile">
                                    <label title="Upload image file" for="inputImage" class="account btn btn-default">
                                        <input type="file" accept="image/*" name="file_logo" id="inputImage" class="hide">Change Photo
                                    </label>
                                </div>
                            </form>
                        </div>

                        <div class="profile-text">
                            <div class="col-sm-12">
                                <form id="update_account" role="form" method="post" action="{{url('api/organization/update_account')}}">
                                    {{csrf_field()}}
                                    <div class="col-md-12">
                                        <p>Organization Name:</p>
                                        <input type="text" name="org_name" id="org_name" class="form-control" value="{{Auth::user()->org_name}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Organization ID:</p>
                                        <input type="text" disabled name="user_id" id="user_id" class="form-control" value="{{Auth::user()->user_name}}">
                                        <p class="p_invalid" id="invalid_username_alert">Invalid ID. Please enter another.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Organization Type:</p>
                                        <select name="org_type" class="form-control" id="org_type">
                                            @foreach($org_type_names as $org_name)
                                            <option <?php if($org_name->id == Auth::user()->org_type){ ?> selected <?php }?> value="{{$org_name->id}}">{{$org_name->organization_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Email:</p>
                                        <input type="text" name="email" id="email" class="form-control" value="{{Auth::user()->email}}">
                                        <p class="p_invalid" id="invalid_email_alert">Invalid Email Address</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Website URL:</p>
                                        <input type="text" name="website" id="website" class="form-control" value="{{Auth::user()->website}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Founded Day:</p>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="birth_day" id="birth_day" class="form-control" value="{{Auth::user()->birth_date}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Address:</p>
                                        <input type="text" name="address" id="address" class="form-control" value="{{Auth::user()->location}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>ZipCode:</p>
                                        <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{Auth::user()->zipcode}}">
                                        <p class="p_invalid" id="invalid_zipcode_alert">Invalid Zipcode. Please enter again</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Contact Number:</p>
                                        <input type="text" name="contact_num" id="contact_num" class="form-control" value="{{Auth::user()->contact_number}}">
                                        <p class="p_invalid" id="invalid_contact_number">Invalid Contact Number</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Facebook URL:</p>
                                        <input type="text" name="facebook_url" id="facebook_url" class="form-control" value="{{Auth::user()->facebook_url}}">
                                    </div>
                                    <div class="col-md-12">
                                        <p>Twitter URL:</p>
                                        <input type="text" name="twitter_url" id="twitter_url" class="form-control" value="{{Auth::user()->twitter_url}}">
                                    </div>
                                    <div class="col-md-12">
                                        <p>LinkedIn URL:</p>
                                        <input type="text" name="linkedin_url" id="linkedin_url" class="form-control" value="{{Auth::user()->linkedin_url}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>New Password:</p>
                                        <input type="password" name="new_password" id="new_password" class="form-control">
                                        <p class="p_invalid" id="invalid_password">Please enter more than 6 letters</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Confirm Password:</p>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                        <p class="p_invalid" id="invalid_confirm">Please confirm password</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Organization Summary:</p>
                                        <textarea name="org_summary" id="org_summary" rows="6" class="form-control">{{Auth::user()->brif}}</textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="btn_save" class="btn btn-primary pull-right" style="margin: 20px 0;">Save Change</button>
                                        <a type="button" href="{{url('/organization/')}}" class="btn btn-primary pull-right" style="margin: 20px 5px; width: 120px;">Back</a>
                                    </div>
                                    <div style="clear: both"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script>

        $('#btn_save').on('click',function(e){
            e.preventDefault;
            var flags = 0;
            if ($("#org_name").val() == ''){
                $("#org_name").css("border","1px solid #ff0000");
                flags++;
            }
            if($('#email').val()=='') {
                $('#email').css("border", "1px solid #ff0000");
                flags++;
            }
            if (!ValidateEmail($('#email').val())) {
                flags++;
                $('#invalid_email_alert').show();
            }
            if($('#birth_day').val()=='') {
                $('#birth_day').css("border", "1px solid #ff0000");
                flags++;
            }
            if($('#address').val()=='') {
                $('#address').css("border", "1px solid #ff0000");
                flags++;
            }
            if($('#zipcode').val()=='') {
                $('#zipcode').css("border", "1px solid #ff0000");
                flags++;
            }
            if (!ValidateZipcode($('#zipcode').val())) {
                flags++;
                $('#zipcode').css("border", "1px solid #ff0000");
                $('#invalid_zipcode_alert').show();
            }
            if($('#contact_num').val()=='') {
                $('#contact_num').css("border", "1px solid #ff0000");
                flags++;
            }
            if (!ValidatePhonepumber($('#contact_num').val())) {
                flags++;
                $('#invalid_contact_number').show();
                $('#contact_num').css("border", "1px solid #ff0000");
            }

            if($('#new_password').val()!='') {
                if (!ValidatePassword($('#new_password').val())) {
                    flags++;
                    $('#invalid_password').show();
                    $('#new_password').css("border", "1px solid #ff0000");
                }
                if($('#new_password').val() != $('#confirm_password').val()){
                    flags++;
                    $('#invalid_confirm').show();
                    $('#confirm_password').css("border", "1px solid #ff0000");
                }
            }
            if(flags == 0){
                $('#update_account').submit();
            }
        });

        $('.form-control').on('click',function () {
            $(this).css("border","1px solid #e5e6e7");
            $(this).parent().find('.p_invalid').hide();
        });

        $(document).ready(function(){
            $('.input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

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