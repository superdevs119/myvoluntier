<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
</head>
<body>
<div style="text-align: center">
    <img src="<?=asset('img/logo/mvlogo.png')?>" style="width: 100px">
    <h2>Forgot your Password?</h2>
    <p>Don't worry! You can reset your password.</p>
    <p>Please reset password by clicking below link.</p>
    <br/>
    <a href="{{url('/forgot_password')}}/{{$user->user_name}}/{{$user->forgot_status}}">Click Here to Reset Password</a>
    <br/>
    <p>Thanks</p>
    <p>support@myvoluntier.com</p>
</div>
</body>
</html>
