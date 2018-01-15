<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-quiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=asset('img/logo/mvlogo.png')?>" type="image/x-icon">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=asset('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="<?=asset('css/animate.css')?>" rel="stylesheet">
    <link href="<?=asset('font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=asset('css/style.css')?>" rel="stylesheet">
</head>
<body class="fixed-sidebar no-skin-config full-height-layout fixed-nav">
<div class="content-panel">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12 animated fadeInRight profile-panel">
                <div class="col-lg-12 profile-info">
                    <form id="create_password" role="form" method="post" action="{{url('api/create_new_password')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h1 style="margin: 0 0 30px 0;">Create New Password:</h1>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <p>New Password:</p>
                                <input type="hidden" name="user_id" value="{{$id}}">
                                <input type="password" name="new_password" id="new_password" class="form-control" value="">
                                <p class="p_invalid" id="invalid_password">Invalid Password.Please enter more than 6 letters.</p>
                            </div>
                            <div class="col-sm-6">
                                <p>Confirm Password:</p>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="">
                                <p class="p_invalid" id="invalid_confirm_password">Confirm password is not correct. Please try again.</p>
                            </div>
                            <button type="button" id="change_password" class="btn btn-primary pull-right" style="margin: 20px 15px 0 0;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="pull-right">
        </div>
        <div class="copy-right">
            <strong>My Voluntier &copy; 2017.</strong> All Rights Reserved
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?=asset('js/jquery-2.1.1.js')?>"></script>
<script src="<?=asset('js/bootstrap.min.js')?>"></script>
<script src="<?=asset('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
<script src="<?=asset('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- Custom and plugin javascript -->
<script src="<?=asset('js/inspinia.js')?>"></script>
<script src="<?=asset('js/plugins/pace/pace.min.js')?>"></script>
<script src="<?=asset('js/global.js')?>"></script>
<script src="<?=asset('js/check_validate.js')?>"></script>
<script>
    $('#change_password').on('click',function (e) {
        e.preventDefault;
        var flags = 0;
        if ($("#new_password").val() == ''){
            $("#new_password").css("border","1px solid #ff0000");
            flags++;
        }
        if ($("#confirm_password").val() == ''){
            $("#confirm_password").css("border","1px solid #ff0000");
            flags++;
        }
        if (!ValidatePassword($('#new_password').val())) {
            flags++;
            $('#invalid_password').show();
        }
        if($('#new_password').val() != $('#confirm_password').val()){
            $('#invalid_confirm_password').show();
            $("#confirm_password").css("border","1px solid #ff0000");
            flags++;
        }
        if(flags == 0){
            $('#create_password').submit();
        }
    })

    $('.form-control').on('click',function () {
        $(this).css("border","1px solid #e5e6e7");
        $(this).parent().find('.p_invalid').hide();
    });
</script>
</body>
</html>
