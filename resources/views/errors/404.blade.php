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
    <title>Page Not Found</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=asset('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="<?=asset('css/animate.css')?>" rel="stylesheet">
    <link href="<?=asset('font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=asset('css/style.css')?>" rel="stylesheet">
</head>
<body class="fixed-nav">
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight profile-panel">
                    <div class="col-lg-12 profile-info">
                        <h1 style="margin: 0 0 30px 0;">Page Not Found! (404 Error)</h1>
                        <div class="profile-image">
                            <div class="profile-image-hover">
                                <img src="<?=asset('img/logo/alert.jpg') ?>" class="m-b-md" alt="profile">
                            </div>
                        </div>
                        <div class="profile-text">
                            <h3 style="margin-top: 120px;">Unauthorized action discovered. Please login and try again.</h3>
                            <a href="{{url('/')}}" class="btn btn-primary" style="margin-top: 20px">Go to Homepage</a>
                        </div>
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
</body>
</html>
