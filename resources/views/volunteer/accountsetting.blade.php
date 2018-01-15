@extends('volunteer.layout.master')

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight profile-panel">
                    <div class="col-lg-12 profile-info">
                        <h1 style="margin: 0 0 30px 0;">My Account Information</h1>
                        <form id="upload_logo" role="form" method="post" action="{{url('api/volunteer/profile/upload_logo')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="profile-image">
                                <div class="profile-image-hover">
                                    <img <?php if(Auth::user()->logo_img == NULL){ ?>src="<?=asset('img/logo/member-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{Auth::user()->logo_img}}" <?php }?> class="img-circle circle-border m-b-md" alt="profile">
                                    <label title="Upload image file" for="inputImage" class="account btn btn-default">
                                        <input type="file" accept="image/*" name="file_logo" id="inputImage" class="hide">Change Photo
                                    </label>
                                </div>
                            </div>
                        </form>

                        <div class="profile-text">
                            <div class="col-sm-12">
                                <form id="update_account" role="form" method="post" action="{{url('api/volunteer/update_account')}}">
                                    {{csrf_field()}}
                                    <div class="col-md-6">
                                        <p>First Name:</p>
                                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{Auth::user()->first_name}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Last Name:</p>
                                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{Auth::user()->last_name}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>User ID:</p>
                                        <input type="text" disabled name="user_id" id="user_id" class="form-control" value="{{Auth::user()->user_name}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Email:</p>
                                        <input type="text" name="email" id="email" class="form-control" value="{{Auth::user()->email}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Birthdate:</p>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="birth_day" id="birth_day" class="form-control" value="{{Auth::user()->birth_date}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Gender:</p>
                                        <div style="margin-bottom: 10px;">
                                            <?php if(Auth::user()->gender == 'male') {?>
                                            <label><input type="radio" checked value="male" id="optionsRadios1" name="sex"> Male</label> &emsp;
                                            <label> <input type="radio" value="female" id="optionsRadios2" name="sex"> Female</label>
                                            <?php }else{?>
                                            <label><input type="radio" value="male" id="optionsRadios1" name="sex"> Male</label> &emsp;
                                            <label> <input type="radio" checked value="female" id="optionsRadios2" name="sex"> Female</label>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p>ZipCode:</p>
                                        <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{Auth::user()->zipcode}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Contact Number:</p>
                                        <input type="text" name="contact_num" id="contact_num" class="form-control" value="{{Auth::user()->contact_number}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p>New Password:</p>
                                        <input type="password" name="new_password" id="new_password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Confirm Password:</p>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <p>My Summary:</p>
                                        <textarea name="my_summary" id="my_summary" rows="6" class="form-control">{{Auth::user()->brif}}</textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="btn_save" class="btn btn-primary pull-right" style="margin: 20px 0;">Save Change</button>
                                        <a type="button" href="{{url('/volunteer/')}}" class="btn btn-primary pull-right" style="margin: 20px 5px; width: 120px;">Back</a>
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
            if ($("#first_name").val() == ''){
                $("#first_name").css("border","1px solid #ff0000");
                flags++;
            }
            if ($("#last_name").val() == ''){
                $("#last_name").css("border","1px solid #ff0000");
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

            var $image = $(".profile-image-hover > img");

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