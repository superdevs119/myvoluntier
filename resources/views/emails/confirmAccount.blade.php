<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirm your account</title>
</head>
<body>
<div style="text-align: center">
    <img src="<?=asset('img/logo/mvlogo.png')?>" style="width: 100px">
    <h2>Welcome to Voluntier.com</h2>
    <p>Thank you for signing up for volunteer activities!</p>
    <p>Please verify Your Email Address by clicking below link.</p>
    <br/>
    <a href="{{url('/confirm_account')}}/{{$user->user_name}}/{{$user->confirm_code}}">Click Here to Confirm</a>
    <br/>
    <p>Thanks</p>
    <p>support@myvoluntier.com</p>
</div>
</body>
</html>
