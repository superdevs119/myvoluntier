@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/nouslider/nouislider.css')?>" rel="stylesheet">
@endsection
@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel">
                    <div class="post-header">
                        <h1>Edit My Opportunity</h1>
                        <p>Please fill below fields and click UPDATE button to update this opportunity</p>
                    </div>
                    <div class="divider"></div>
                    <form id="post_opportunity" role="form" method="post" action="{{url('api/organization/edit_opportunity')}}/{{$oppr_info->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="post-body">
                            <div class="main-info">
                                <h2>Opportunity Info</h2>
                                <div class="profile-image-hover">
                                    <img <?php if($oppr_info->logo_img == ''){ ?>src="<?=asset('img/logo/opportunity-default-logo.png')?>" <?php }else{?>src="<?=asset('uploads')?>/{{$oppr_info->logo_img}}" <?php } ?> class="img-circle circle-border m-b-md" alt="profile">
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                        <input type="file" accept="image/*" name="file_logo" id="inputImage" class="hide">Upload Logo
                                    </label>
                                </div>
                                <div style="clear: both;"></div>
                                <p>Opportunity Title:</p>
                                <input type="text" name="title" class="form-control" id="title" value="{{$oppr_info->title}}">
                                <p>Opportunity Type:</p>
                                <select name="opportunity_type" class="form-control" id="opportunity_type">
                                    @foreach($opportunity_category as $oc)
                                        <option <?php if($oppr_info->category_id == $oc->id){?> selected <?php } ?> value="{{$oc->id}}">{{$oc->name}}</option>
                                    @endforeach
                                </select>
                                <p>Opportunity Description:</p>
                                <textarea rows="5" name="description" class="form-control" id="description">{{$oppr_info->description}}</textarea>
                                <p>Minimum Age:</p>
                                <select class="form-control" name="min_age" id="min_age">
                                    <option <?php if($oppr_info->min_age == 13){?> selected <?php } ?> value="13">13</option>
                                    <option <?php if($oppr_info->min_age == 15){?> selected <?php } ?> value="15">15</option>
                                    <option <?php if($oppr_info->min_age == 17){?> selected <?php } ?> value="17">17</option>
                                    <option <?php if($oppr_info->min_age == 20){?> selected <?php } ?> value="20">20</option>
                                    <option <?php if($oppr_info->min_age == 30){?> selected <?php } ?> value="30">30</option>
                                </select>
                                <p>Activities:</p>
                                <textarea rows="5" name="activity" class="form-control" id="activity">{{$oppr_info->activity}}</textarea>
                                <p>Qualifications:</p>
                                <textarea rows="3" name="qualification" class="form-control" id="qualification">{{$oppr_info->qualification}}</textarea>
                            </div>
                            <div class="addr-info">
                                <h2>Address</h2>
                                <p>Street1:</p>
                                <input type="text" name="street1" class="form-control" id="street1" value="{{$oppr_info->street_addr1}}">
                                <p>Street2:</p>
                                <input type="text" name="street2" class="form-control" id="street2" value="{{$oppr_info->street_addr2}}">
                                <p>City:</p>
                                <input type="text" name="city" class="form-control" id="city"  value="{{$oppr_info->city}}">
                                <p>State:</p>
                                <select name="state" class="form-control" id="state">
                                    <option <?php if($oppr_info->state == 'AL'){?> selected <?php } ?> value="AL">Alabama</option>
                                    <option <?php if($oppr_info->state == 'AK'){?> selected <?php } ?> value="AK">Alaska</option>
                                    <option <?php if($oppr_info->state == 'AZ'){?> selected <?php } ?> value="AZ">Arizona</option>
                                    <option <?php if($oppr_info->state == 'AR'){?> selected <?php } ?> value="AR">Arkansas</option>
                                    <option <?php if($oppr_info->state == 'CA'){?> selected <?php } ?> value="CA">California</option>
                                    <option <?php if($oppr_info->state == 'CO'){?> selected <?php } ?> value="CO">Colorado</option>
                                    <option <?php if($oppr_info->state == 'CT'){?> selected <?php } ?> value="CT">Connecticut</option>
                                    <option <?php if($oppr_info->state == 'DE'){?> selected <?php } ?> value="DE">Delaware</option>
                                    <option <?php if($oppr_info->state == 'DC'){?> selected <?php } ?> value="DC">District Of Columbia</option>
                                    <option <?php if($oppr_info->state == 'FL'){?> selected <?php } ?> value="FL">Florida</option>
                                    <option <?php if($oppr_info->state == 'GA'){?> selected <?php } ?> value="GA">Georgia</option>
                                    <option <?php if($oppr_info->state == 'HI'){?> selected <?php } ?> value="HI">Hawaii</option>
                                    <option <?php if($oppr_info->state == 'ID'){?> selected <?php } ?> value="ID">Idaho</option>
                                    <option <?php if($oppr_info->state == 'IL'){?> selected <?php } ?> value="IL">Illinois</option>
                                    <option <?php if($oppr_info->state == 'IN'){?> selected <?php } ?> value="IN">Indiana</option>
                                    <option <?php if($oppr_info->state == 'IA'){?> selected <?php } ?> value="IA">Iowa</option>
                                    <option <?php if($oppr_info->state == 'KA'){?> selected <?php } ?> value="KS">Kansas</option>
                                    <option <?php if($oppr_info->state == 'KY'){?> selected <?php } ?> value="KY">Kentucky</option>
                                    <option <?php if($oppr_info->state == 'LA'){?> selected <?php } ?> value="LA">Louisiana</option>
                                    <option <?php if($oppr_info->state == 'ME'){?> selected <?php } ?> value="ME">Maine</option>
                                    <option <?php if($oppr_info->state == 'MD'){?> selected <?php } ?> value="MD">Maryland</option>
                                    <option <?php if($oppr_info->state == 'MA'){?> selected <?php } ?> value="MA">Massachusetts</option>
                                    <option <?php if($oppr_info->state == 'MI'){?> selected <?php } ?> value="MI">Michigan</option>
                                    <option <?php if($oppr_info->state == 'MN'){?> selected <?php } ?> value="MN">Minnesota</option>
                                    <option <?php if($oppr_info->state == 'MS'){?> selected <?php } ?> value="MS">Mississippi</option>
                                    <option <?php if($oppr_info->state == 'MO'){?> selected <?php } ?> value="MO">Missouri</option>
                                    <option <?php if($oppr_info->state == 'MT'){?> selected <?php } ?> value="MT">Montana</option>
                                    <option <?php if($oppr_info->state == 'NE'){?> selected <?php } ?> value="NE">Nebraska</option>
                                    <option <?php if($oppr_info->state == 'NV'){?> selected <?php } ?> value="NV">Nevada</option>
                                    <option <?php if($oppr_info->state == 'NH'){?> selected <?php } ?> value="NH">New Hampshire</option>
                                    <option <?php if($oppr_info->state == 'NJ'){?> selected <?php } ?> value="NJ">New Jersey</option>
                                    <option <?php if($oppr_info->state == 'NM'){?> selected <?php } ?> value="NM">New Mexico</option>
                                    <option <?php if($oppr_info->state == 'NY'){?> selected <?php } ?> value="NY">New York</option>
                                    <option <?php if($oppr_info->state == 'NC'){?> selected <?php } ?> value="NC">North Carolina</option>
                                    <option <?php if($oppr_info->state == 'ND'){?> selected <?php } ?> value="ND">North Dakota</option>
                                    <option <?php if($oppr_info->state == 'OH'){?> selected <?php } ?> value="OH">Ohio</option>
                                    <option <?php if($oppr_info->state == 'OK'){?> selected <?php } ?> value="OK">Oklahoma</option>
                                    <option <?php if($oppr_info->state == 'OR'){?> selected <?php } ?> value="OR">Oregon</option>
                                    <option <?php if($oppr_info->state == 'PA'){?> selected <?php } ?> value="PA">Pennsylvania</option>
                                    <option <?php if($oppr_info->state == 'RI'){?> selected <?php } ?> value="RI">Rhode Island</option>
                                    <option <?php if($oppr_info->state == 'SC'){?> selected <?php } ?> value="SC">South Carolina</option>
                                    <option <?php if($oppr_info->state == 'SD'){?> selected <?php } ?> value="SD">South Dakota</option>
                                    <option <?php if($oppr_info->state == 'TN'){?> selected <?php } ?> value="TN">Tennessee</option>
                                    <option <?php if($oppr_info->state == 'TX'){?> selected <?php } ?> value="TX">Texas</option>
                                    <option <?php if($oppr_info->state == 'UT'){?> selected <?php } ?> value="UT">Utah</option>
                                    <option <?php if($oppr_info->state == 'VT'){?> selected <?php } ?> value="VT">Vermont</option>
                                    <option <?php if($oppr_info->state == 'VA'){?> selected <?php } ?> value="VA">Virginia</option>
                                    <option <?php if($oppr_info->state == 'WA'){?> selected <?php } ?> value="WA">Washington</option>
                                    <option <?php if($oppr_info->state == 'WV'){?> selected <?php } ?> value="WV">West Virginia</option>
                                    <option <?php if($oppr_info->state == 'WI'){?> selected <?php } ?> value="WI">Wisconsin</option>
                                    <option <?php if($oppr_info->state == 'WY'){?> selected <?php } ?> value="WY">Wyoming</option>
                                </select>
                                <p>Zipcode:</p>
                                <input type="text" name="zipcode" class="form-control" id="zipcode"  value="{{$oppr_info->zipcode}}">
                                <p class="p_invalid" id="invalid_zipcode_alert">Invalid ID. Please enter another.</p>
                                <p>Additional Info:</p>
                                <textarea rows="5" name="add_info" class="form-control">{{$oppr_info->additional_info}}</textarea>
                            </div>
                            <div class="time-info">
                                <h2>Time Info</h2>
                                <div class="start-date">
                                    <p>Start Date:</p>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" id="start_date" class="form-control" value="{{date("m/d/Y",strtotime($oppr_info->start_date))}}">
                                    </div>
                                </div>
                                <div class="end-date">
                                    <p>End Date:</p>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" id="end_date" class="form-control" value="{{date("m/d/Y",strtotime($oppr_info->end_date))}}">
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <p>Time Range:</p>
                                <div class="time_range">
                                    <div class="tracking-slider">
                                        <input type="hidden" name="start_at" id="start_at" value="{{$oppr_info->start_at}}">
                                        <input type="hidden" name="end_at" id="end_at" value="{{$oppr_info->end_at}}">
                                    </div>
                                </div>
                                <p>Select Week days:</p>
                                <select class="weekday_select form-control" name="weekdays" id="weekdays" multiple="multiple">
                                    <option <?php if(strpos($oppr_info->weekdays, 'Monday')!==false) {?> selected <?php } ?> value="Monday">Monday</option>
                                    <option <?php if(strpos($oppr_info->weekdays, 'Tuesday')!==false) {?> selected <?php } ?> value="Tuesday">Tuesday</option>
                                    <option <?php if(strpos($oppr_info->weekdays, 'Wednesday')!==false) {?> selected <?php } ?> value="Wednesday">Wednesday</option>
                                    <option <?php if(strpos($oppr_info->weekdays, 'Thursday')!==false) {?> selected <?php } ?> value="Thursday">Thursday</option>
                                    <option <?php if(strpos($oppr_info->weekdays, 'Friday')!==false) {?> selected <?php } ?> value="Friday">Friday</option>
                                    <option <?php if(strpos($oppr_info->weekdays, 'Saturday')!==false) {?> selected <?php } ?> value="Saturday">Saturday</option>
                                    <option <?php if(strpos($oppr_info->weekdays, 'Sunday')!==false) {?> selected <?php } ?> value="Sunday">Sunday</option>
                                </select>
                                <input type="hidden" id="weekday_vals" name="weekday_vals" value="{{$oppr_info->weekdays}}">
                            </div>
                            <div class="contact-info">
                                <h2>Contact Info</h2>
                                <div class="col-md-4">
                                    <p>Contact name:</p>
                                    <input type="text" name="contact_name" class="form-control" id="contact_name" value="{{$oppr_info->contact_name}}">
                                </div>
                                <div class="col-md-4">
                                    <p>Contact Email:</p>
                                    <input type="text" name="contact_email" class="form-control" id="contact_email" value="{{$oppr_info->contact_email}}">
                                    <p class="p_invalid" id="invalid_email_alert">Invalid email address.</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Contact Phone:</p>
                                    <input type="text" name="contact_phone" class="form-control" id="contact_phone" value="{{$oppr_info->contact_number}}">
                                    <p class="p_invalid" id="invalid_phone_alert">Invalid Phone number.</p>
                                </div>

                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="divider"></div>
                        <div class="post-footer">
                            <button type="button" id="btn_post" class="btn btn-primary pull-right">Update Opportunity</button>
                            <a type="button" href="{{url('/organization/opportunity')}}" class="btn btn-danger pull-right" style="margin-right: 5px">Close</a>
                            <div style="clear: both;"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script src="<?=asset('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
            <script src="<?=asset('js/plugins/select2/select2.full.min.js')?>"></script>
            <script src="<?=asset('js/plugins/nouslider/nouislider.js')?>"></script>
            <script>
                $('#btn_post').on('click',function(e){
                    e.preventDefault;
                    var flags = 0;
                    if ($("#title").val() == ''){
                        $("#title").css("border","1px solid #ff0000");
                        flags++;
                    }
                    if ($("#description").val() == ''){
                        $("#description").css("border","1px solid #ff0000");
                        flags++;
                    }
                    if ($("#activity").val() == ''){
                        $("#activity").css("border","1px solid #ff0000");
                        flags++;
                    }
                    if ($("#qualification").val() == ''){
                        $("#qualification").css("border","1px solid #ff0000");
                        flags++;
                    }
                    if ($("#street1").val() == ''){
                        $("#street1").css("border","1px solid #ff0000");
                        flags++;
                    }
                    if ($("#city").val() == ''){
                        $("#city").css("border","1px solid #ff0000");
                        flags++;
                    }
                    if ($("#state").val() == ''){
                        $("#state").css("border","1px solid #ff0000");
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
                    if ($("#start_date").val() == ''){
                        $("#start_date").css("border","1px solid #ff0000");
                        flags++;
                    }
                    if ($("#end_date").val() == ''){
                        $("#end_date").css("border","1px solid #ff0000");
                        flags++;
                    }
                    if ($("#weekdays").val() == ''){
                        $("#weekdays").css("border","1px solid #ff0000");
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
//                        $inputImage.val("");
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

                $('.input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });

                $('.weekday_select').select2();

                function toTime(current_time){
                    var mins = parseInt(current_time);
                    var min = mins%60;
                    var hours = (mins-min)/60;
                    var day = 'AM';
                    if(min < 10){
                        min = '0'+min.toString();
                    }else{
                        min = min.toString();
                    }
                    if (hours >= 12 && hours < 24){
                        day = 'PM';
                    }
                    if(hours > 12){
                        hours = hours-12;
                    }
                    return hours.toString()+':'+min.toString()+day;
                }

                function toMin(current_time){
                    var current_min;
                    if(current_time.slice(-2)=='AM'){
                        if(current_time.slice(0,-5)=='12'){
                            current_min = 1440;
                            return current_min;
                        }else {
                            current_min = parseInt(current_time.slice(0,-5))*60;
                            current_min = current_min+parseInt(current_time.slice(0,-2).slice(-2));
                            return current_min;
                        }
                    }else{
                        if(current_time.slice(0,-5)=='12'){
                            current_min = 720+parseInt(current_time.slice(0,-2).slice(-2));
                            return current_min;
                        }else {
                            current_min = 720+parseInt(current_time.slice(0,-5))*60;
                            current_min = current_min+parseInt(current_time.slice(0,-2).slice(-2));
                            return current_min;
                        }
                    }
                }

                var slider = $('.tracking-slider');
                var slider = slider[0];
                var start_at = toMin($('#start_at').val());
                var end_at = toMin($('#end_at').val());

                noUiSlider.create(slider, {
                    animate: true,
                    start: [start_at,end_at],
                    step: 30,
                    tooltips: true,
                    format: {to: toTime, from: Number},
                    connect: true,
                    range: {
                        'min':0,
                        'max': 1440
                    }
                });

                $('.noUi-tooltip').each(function(){
                    var width = $(this).width();
                    var padding = $(this).css('padding-left');
                    var margin = parseInt(width/2) + parseInt(padding) + 2;
                });


                /* click tooltip */
                $('.noUi-tooltip').on('click', function(){
                    $(this).find('.input-tooltip')
                            .focus()
                            .keydown(function (e){
                                if(e.keyCode == 13){
                                    var valor = $(this).val();
                                    slider.noUiSlider.set(valor);
                                    if (slider.noUiSlider.get() < 20){
                                        slider.noUiSlider.set(20);
                                    }
                                }

                            })
                            .focusout(function(){
                                var valor = $(this).val();
                                slider.noUiSlider.set(valor);
                            });
                });

                slider.noUiSlider.on('change', function ( values, handle ) {
                    $('#start_at').val(values[0]);
                    $('#end_at').val(values[1]);
                });
            </script>
@endsection