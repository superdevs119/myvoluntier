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
                        <h1>Posting New Opportunity</h1>
                        <p>Please fill below fields and click POST button to post opportunity</p>
                    </div>
                    <div class="divider"></div>
                    <form id="post_opportunity" role="form" method="post" action="{{url('api/organization/post_opportunity')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="post-body">
                            <div class="main-info">
                                <h2>Opportunity Info</h2>
                                <div class="profile-image-hover">
                                    <img src="<?=asset('img/logo/opportunity-default-logo.png')?>" class="img-circle circle-border m-b-md" alt="profile">
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                        <input type="file" accept="image/*" name="file_logo" id="inputImage" class="hide">Upload Logo
                                    </label>
                                </div>
                                <div style="clear: both;"></div>
                                <p>Opportunity Title:</p>
                                <input type="text" name="title" class="form-control" id="title" value="">
                                <p>Opportunity Type:</p>
                                <select name="opportunity_type" class="form-control" id="opportunity_type">
                                    @foreach($opportunity_category as $oc)
                                        <option value="{{$oc->id}}">{{$oc->name}}</option>
                                    @endforeach
                                </select>
                                <p>Opportunity Description:</p>
                                <textarea rows="5" name="description" class="form-control" id="description"></textarea>
                                <p>Minimum Age:</p>
                                <select class="form-control" name="min_age" id="min_age">
                                    <option value="13">13</option>
                                    <option value="15">15</option>
                                    <option value="17">17</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                </select>
                                <p>Activities:</p>
                                <textarea rows="5" name="activity" class="form-control" id="activity"></textarea>
                                <p>Qualifications:</p>
                                <textarea rows="3" name="qualification" class="form-control" id="qualification"></textarea>
                            </div>
                            <div class="addr-info">
                                <h2>Address</h2>
                                <p>Street1:</p>
                                <input type="text" name="street1" class="form-control" id="street1">
                                <p>Street2:</p>
                                <input type="text" name="street2" class="form-control" id="street2">
                                <p>City:</p>
                                <input type="text" name="city" class="form-control" id="city">
                                <p>State:</p>
                                <select name="state" class="form-control" id="state">
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                                <p>Zipcode:</p>
                                <input type="text" name="zipcode" class="form-control" id="zipcode">
                                <p class="p_invalid" id="invalid_zipcode_alert">Invalid ID. Please enter another.</p>
                                <p>Additional Info:</p>
                                <textarea rows="5" name="add_info" class="form-control"></textarea>
                            </div>
                            <div class="time-info">
                                <h2>Time Info</h2>
                                <div class="start-date">
                                    <p>Start Date:</p>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" id="start_date" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="end-date">
                                    <p>End Date:</p>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" id="end_date" class="form-control" value="">
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <p>Time Range:</p>
                                <div class="time_range">
                                    <div class="tracking-slider">
                                        <input type="hidden" name="start_at" id="start_at" value="6:00AM">
                                        <input type="hidden" name="end_at" id="end_at" value="6:00PM">
                                    </div>
                                </div>
                                <p>Select Week days:</p>
                                <div class="select-week checkbox checkbox-primary">
                                    <label style="min-width: 100px"><input type="checkbox" name="monday"> Monday</label>
                                    <label style="min-width: 100px"><input type="checkbox" name="tuesday"> Tuesday</label>
                                    <label style="min-width: 100px"><input type="checkbox" name="wednesday"> Wednesday</label>
                                    <label style="min-width: 100px"><input type="checkbox" name="thursday"> Thursday</label>
                                    <label style="min-width: 100px"><input type="checkbox" name="friday"> Friday</label>
                                    <label style="min-width: 100px"><input type="checkbox" name="saturday"> Saturday</label>
                                    <label style="min-width: 100px"><input type="checkbox" name="sunday"> Sunday</label>
                                </div>
                                {{--<select class="weekday_select form-control" name="weekdays" id="weekdays" multiple="multiple">--}}
                                    {{--<option value="Monday">Monday</option>--}}
                                    {{--<option value="Tuesday">Tuesday</option>--}}
                                    {{--<option value="Wednesday">Wednesday</option>--}}
                                    {{--<option value="Thursday">Thursday</option>--}}
                                    {{--<option value="Friday">Friday</option>--}}
                                    {{--<option value="Saturday">Saturday</option>--}}
                                    {{--<option value="Sunday">Sunday</option>--}}
                                {{--</select>--}}
                                {{--<input type="hidden" id="weekday_vals" name="weekday_vals">--}}
                            </div>
                            <div class="contact-info">
                                <h2>Contact Info</h2>
                                <div class="col-md-4">
                                    <p>Contact name:</p>
                                    <input type="text" name="contact_name" class="form-control" id="contact_name">
                                </div>
                                <div class="col-md-4">
                                    <p>Contact Email:</p>
                                    <input type="text" name="contact_email" class="form-control" id="contact_email">
                                    <p class="p_invalid" id="invalid_email_alert">Invalid email address.</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Contact Phone:</p>
                                    <input type="text" name="contact_phone" class="form-control" id="contact_phone">
                                    <p class="p_invalid" id="invalid_phone_alert">Invalid Phone number.</p>
                                </div>

                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="divider"></div>
                        <div class="post-footer">
                            <button type="button" id="btn_post" class="btn btn-primary pull-right">Post Opportunity</button>
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
        minDate: 0,
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

    var slider = $('.tracking-slider');
    var slider = slider[0];

    noUiSlider.create(slider, {
        animate: true,
        start: [360,1080],
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