@extends('volunteer.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/nouslider/nouislider.css')?>" rel="stylesheet">
    <style>
        .group-info-field{
            width: 100%;
            float: right;
            border: 1px solid#ddd;
            background: #fafafa;
            padding: 20px;}
    </style>
@endsection
@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel">
                    @if($group_id == null)
                        <div class="post-header">
                            <h1>Creating New Group</h1>
                            <p>You can create new Group right now. Fill below boxes and click "Create Group" button!</p>
                        </div>
                        <div class="divider"></div>
                        <form id="post_opportunity" role="form" method="post" action="{{url('api/volunteer/group/create_org_group')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="post-body">
                                <div class="group-info-field">
                                    <h2>Group Information</h2>
                                    <div class="profile-image-hover">
                                        <img src="<?=asset('img/logo/group-default-logo.png')?>" class="img-circle circle-border m-b-md" alt="profile">
                                        <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                            <input type="file" accept="image/*" name="file_logo" id="inputImage" class="hide">Upload Logo
                                        </label>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <p>Group Name:</p>
                                    <input type="text" name="group_name" class="form-control" id="group_name" value="">
                                    <p>Group Description:</p>
                                    <textarea rows="5" name="description" class="form-control" id="description"></textarea>
                                </div>
                                <div class="contact-info">
                                    <h2>Contact Info</h2>
                                    <div class="col-md-4">
                                        <p>Contact name:</p>
                                        <input type="text" name="contact_name" class="form-control" id="contact_name" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}">
                                    </div>
                                    <div class="col-md-4">
                                        <p>Contact Email:</p>
                                        <input type="text" name="contact_email" class="form-control" id="contact_email" value="{{Auth::user()->email}}">
                                        <p class="p_invalid" id="invalid_email_alert">Invalid email address.</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Contact Phone:</p>
                                        <input type="text" name="contact_phone" class="form-control" id="contact_phone" value="{{Auth::user()->contact_number}}">
                                        <p class="p_invalid" id="invalid_phone_alert">Invalid Phone number.</p>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                            <div class="divider"></div>
                            <div class="post-footer">
                                <button type="button" id="btn_create_group" class="btn btn-primary pull-right">Create Group</button>
                                <a href="{{url('/volunteer/group')}}" type="button" id="btn_create_group" class="btn btn-danger pull-right" style="margin-right: 5px">Back</a>
                                <div style="clear: both;"></div>
                            </div>
                        </form>
                    @else
                        <div class="post-header">
                            <h1>Edit Group</h1>
                            <p>You can Edit Group here. Only Administrator can edit Group contents!</p>
                        </div>
                        <div class="divider"></div>
                        <form id="post_opportunity" role="form" method="post" action="{{url('api/organization/group/change_org_group')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="post-body">
                                <div class="group-info-field">
                                    <h2>Group Information</h2>
                                    <div class="profile-image-hover">
                                        @if($group_info->logo_img == null)
                                            <img src="<?=asset('img/logo/group-default-logo.png')?>" class="img-circle circle-border m-b-md" alt="profile">
                                        @else
                                            <img src="{{url('/uploads')}}/{{$group_info->logo_img}}" class="img-circle circle-border m-b-md" alt="profile">
                                        @endif
                                        <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                            <input type="file" accept="image/*" name="file_logo" id="inputImage" class="hide">Upload Logo
                                        </label>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <p>Group Name:</p>
                                    <input type="text" name="group_name" class="form-control" id="group_name" value="{{$group_info->name}}">
                                    <p>Group Description:</p>
                                    <textarea rows="5" name="description" class="form-control" id="description">{{$group_info->description}}</textarea>
                                </div>
                                <div class="contact-info">
                                    <h2>Contact Info</h2>
                                    <div class="col-md-4">
                                        <p>Contact name:</p>
                                        <input type="text" name="contact_name" class="form-control" id="contact_name" value="{{Auth::user()->org_name}}">
                                    </div>
                                    <div class="col-md-4">
                                        <p>Contact Email:</p>
                                        <input type="text" name="contact_email" class="form-control" id="contact_email" value="{{Auth::user()->email}}">
                                        <p class="p_invalid" id="invalid_email_alert">Invalid email address.</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Contact Phone:</p>
                                        <input type="text" name="contact_phone" class="form-control" id="contact_phone" value="{{Auth::user()->contact_number}}">
                                        <p class="p_invalid" id="invalid_phone_alert">Invalid Phone number.</p>
                                    </div>
                                </div>
                                <input type="hidden" name="group_id" id="group_id" value="{{$group_id}}">
                                <div style="clear: both;"></div>
                            </div>
                            <div class="divider"></div>
                            <div class="post-footer">
                                <button type="button" id="btn_create_group" class="btn btn-primary pull-right">Change Group</button>
                                <a href="{{url('/organization/group')}}" type="button" id="btn_create_group" class="btn btn-danger pull-right" style="margin-right: 5px">Back</a>
                                <div style="clear: both;"></div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
         $('#btn_create_group').on('click',function(e) {
             e.preventDefault;
             var flags = 0;
             if ($("#group_name").val() == ''){
                 $("#group_name").css("border","1px solid #ff0000");
                    flags++;
                 }
             if ($("#description").val() == ''){
                 $("#description").css("border","1px solid #ff0000");
                 flags++;
             }
             if($('#contact_name').val()=='') {
                 $('#contact_name').css("border", "1px solid #ff0000");
                 flags++;
             }
             if($('#contact_email').val()=='') {
                 $('#contact_email').css("border", "1px solid #ff0000");
                 flags++;
             }
             if (!ValidateEmail($('#contact_email').val())) {
                 flags++;
                 $('#invalid_email_alert').show();
             }
             if($('#contact_phone').val()=='') {
                 $('#contact_email').css("border", "1px solid #ff0000");
                 $('#invalid_email_alert').show();
                 flags++;
             }
             if (!ValidatePhonepumber($('#contact_phone').val())) {
                 flags++;
                 $('#invalid_phone_alert').show();
                 $('#contact_phone').css("border", "1px solid #ff0000");
             }
             if(flags == 0){
                 $('#post_opportunity').submit();
             }
         });

         $('.form-control').on('click',function () {
             $(this).css("border","1px solid #e5e6e7");
             $(this).parent().find('.p_invalid').hide();
         });

         $(document).ready(function(){
             $('#weekdays').change(function () {
                 $('#weekday_vals').val($('#weekdays').val());
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
//                           $inputImage.val("");
                             $image.attr('src', e.target.result);
                         };
                     } else {
                         showMessage("Please choose an image file.");
                     }
                 });
             }else {
                 $inputImage.addClass("hide");
             }
         });
    </script>
@endsection